<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
    header("Location: login.html");
    exit;
}

header('Content-Type: application/json');
require_once 'db_config.php'; // Fichier de configuration pour la connexion (variables $host, $dbname, $username, $password)

// Vérification des champs obligatoires
if (!isset($_POST['title'], $_POST['content'], $_POST['visibility'], $_FILES['illustration'], $_FILES['cover'])) {
    echo json_encode(['error' => 'Tous les champs sont obligatoires.']);
    exit;
}

$title      = trim($_POST['title']);
$content    = trim($_POST['content']);
$resume    = trim($_POST['resume']);
$category    = $_POST['category'];
$visibility = $_POST['visibility'];

// Vérification des fichiers uploadés
if ($_FILES['illustration']['error'] !== UPLOAD_ERR_OK || $_FILES['cover']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['error' => 'Erreur lors du téléchargement des images.']);
    exit;
}

// Répertoire de destination pour les uploads
$uploadsDir = 'article/uploads/';
if (!is_dir($uploadsDir)) {
    mkdir($uploadsDir, 0755, true);
}

// Traitement du fichier "illustration"
$illustrationTmp  = $_FILES['illustration']['tmp_name'];
$illustrationName = basename($_FILES['illustration']['name']);
$illustrationExt  = pathinfo($illustrationName, PATHINFO_EXTENSION);
// Génération d'un nom unique pour éviter les collisions
$illustrationFileName = uniqid('illustration_', true) . '.' . $illustrationExt;
$illustrationPath     = $uploadsDir . $illustrationFileName;

if (!move_uploaded_file($illustrationTmp, $illustrationPath)) {
    echo json_encode(['error' => "Erreur lors du déplacement de l'image d'illustration."]);
    exit;
}

// Traitement du fichier "cover"
$coverTmp  = $_FILES['cover']['tmp_name'];
$coverName = basename($_FILES['cover']['name']);
$coverExt  = pathinfo($coverName, PATHINFO_EXTENSION);
$coverFileName = uniqid('cover_', true) . '.' . $coverExt;
$coverPath     = $uploadsDir . $coverFileName;

if (!move_uploaded_file($coverTmp, $coverPath)) {
    echo json_encode(['error' => "Erreur lors du déplacement de l'image de couverture."]);
    exit;
}

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur de connexion à la base de données : ' . $e->getMessage()]);
    exit;
}

// Préparation et exécution de la requête d'insertion
$stmt = $pdo->prepare("INSERT INTO articles (title, content, resume, category, img_illustration, img_cover, visibility, author, publication_date) VALUES (:title, :content, :resume, :category, :illustration, :cover, :visibility, :author, :publication_date)");
$stmt->bindParam(':title', $title, PDO::PARAM_STR);
$stmt->bindParam(':content', $content, PDO::PARAM_STR);
$stmt->bindParam(':resume', $resume, PDO::PARAM_STR);
$stmt->bindParam(':category', $category, PDO::PARAM_STR);
$stmt->bindParam(':illustration', $illustrationPath, PDO::PARAM_STR);
$stmt->bindParam(':cover', $coverPath, PDO::PARAM_STR);
$stmt->bindParam(':visibility', $visibility, PDO::PARAM_STR);
$stmt->bindParam(':author', $_SESSION['username'], PDO::PARAM_STR);
$stmt->bindParam(':publication_date', $_POST['date'], PDO::PARAM_STR);

if ($stmt->execute()) {
    echo json_encode(['success' => 'Article créé avec succès.']);
} else {
    echo json_encode(['error' => 'Erreur lors de la création de l\'article.', 'details' => $stmt->errorInfo()]);
}
?>
