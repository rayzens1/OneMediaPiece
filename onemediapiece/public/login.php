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

$hash = password_hash($password, PASSWORD_BCRYPT);

$stmt = $pdo->prepare("SELECT password FROM users WHERE email = :email");
$stmt->bindParam(':email', $email, PDO::PARAM_STR);

// Exécuter la requête
$stmt->execute();

// Récupérer le hash du mot de passe
$passwordHash = $stmt->fetchColumn();

//echo json_encode(['hash' => $passwordHash, 'email' => $email, 'isset' => isset($passwordHash)]);


if(isset($passwordHash)) {
    if (password_verify($password, $passwordHash)) {
        
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $id = $stmt->fetchColumn();

        $stmt = $pdo->prepare("SELECT username FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $username = $stmt->fetchColumn();
        
        session_start();
        
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        
        echo json_encode(['code' => 200, 'message' => 'mot de passe bon']);
    } else {
        echo json_encode(['code' => 400, 'message' => 'mot de passe incorrect']);
    }
} else {
    echo json_encode(['code' => 400, 'message' => 'No user']);
}

?>