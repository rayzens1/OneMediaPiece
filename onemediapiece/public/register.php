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

$password = null;
if (isset($_POST['password'])) {
    $password = $_POST['password'];
} else {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);
    if (isset($data['password'])) {
        $email = $data['password'];
    }
}

$username = null;
if (isset($_POST['username'])) {
    $username = $_POST['username'];
} else {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);
    if (isset($data['username'])) {
        $username = $data['username'];
    }
}

if (!$email) {
    http_response_code(400);
    echo json_encode(['error' => 'Email non fourni']);
    exit;
}
if (!$password) {
    http_response_code(400);
    echo json_encode(['error' => 'Password non fourni']);
    exit;
}
if (!$username) {
    http_response_code(400);
    echo json_encode(['error' => 'Username non fourni']);
    exit;
}

$hash = password_hash($password, PASSWORD_BCRYPT);

try {
    // Préparation de la requête d'insertion
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :hash)");
    
    // Lier les paramètres à la requête préparée
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
    
    // Exécuter la requête
    $stmt->execute();
    
    echo json_encode(['message' => 'Utilisateur créé avec succès.', 'code' => 200]);
} catch (PDOException $e) {
    // Gestion des erreurs
    echo json_encode(['error' => 'Erreur : ' . $e->getMessage()]);
}

// Retourner le résultat sous forme de JSON
// echo json_encode(['exists' => $exists, 'email' => $email, 'code' => 200]);
?>