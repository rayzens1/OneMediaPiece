<?php
require_once 'db_config.php';

header('Content-Type: application/json');

try {
    // Connexion à la base de données via PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => "Erreur de connexion : " . $e->getMessage()]);
    exit;
}

// Récupérer l'email envoyé en POST ou via un payload JSON
$email = null;
if (isset($_POST['email'])) {
    $email = $_POST['email'];
} else {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);
    if (isset($data['email'])) {
        $email = $data['email'];
    }
}

if (!$email) {
    http_response_code(400);
    echo json_encode(['error' => 'Email non fourni']);
    exit;
}

// Préparation et exécution de la requête SQL pour vérifier la présence de l'email
$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$count = $stmt->fetchColumn();

// Déterminer si l'email est présent (true si au moins un utilisateur trouvé, false sinon)
$exists = ($count > 0);

// Retourner le résultat sous forme de JSON
echo json_encode(['exists' => $exists, 'email' => $email]);
?>