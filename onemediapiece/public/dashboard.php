<?php
    session_start();

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
        header("Location: login.html");
        exit;
    }
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: Arial, sans-serif;
    }
    .dashboard {
      display: flex;
      height: 100vh;
    }
    .sidebar {
      width: 250px;
      background-color: #2c3e50;
      color: #ecf0f1;
      padding: 20px;
    }
    .sidebar h2 {
      margin-bottom: 20px;
      font-size: 1.5rem;
    }
    .sidebar ul {
      list-style: none;
    }
    .sidebar li {
      padding: 10px 0;
      border-bottom: 1px solid #34495e;
      cursor: pointer;
    }
    .sidebar li:hover {
      background-color: #34495e;
    }
    .main {
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .header {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      background-color: #ecf0f1;
      padding: 15px 20px;
      border-bottom: 1px solid #bdc3c7;
    }
    .dropdown {
      position: relative;
      display: inline-block;
    }
    .dropdown-btn {
      background-color: #3498db;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 1rem;
    }
    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background-color: #fff;
      min-width: 150px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      z-index: 1;
    }
    .dropdown-content a {
      display: block;
      padding: 12px 16px;
      color: #333;
      text-decoration: none;
    }
    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }
    .dropdown.show .dropdown-content {
      display: block;
    }
    .content {
      padding: 20px;
      flex: 1;
      background-color: #f4f6f8;
    }
    a {
        text-decoration: none;
        color: inherit;
    }
  </style>
</head>
<body>
  <div class="dashboard">
    <aside class="sidebar">
      <a href="dashboard.php"><h2>Outils</h2></a>
      <ul>
        <a href="create_article.php"><li>Créer Article</li></a>
        <li>Outil 2</li>
        <li>Outil 3</li>
        <li>Outil 4</li>
      </ul>
    </aside>
    <div class="main">
      <header class="header">
        <div class="dropdown">
          <button class="dropdown-btn" onclick="toggleDropdown()"><?php echo htmlspecialchars(isset($_SESSION['username']) ? $_SESSION['username'] : 'Utilisateur'); ?></button>
          <div class="dropdown-content">
            <a href="#">Profil</a>
            <a href="#">Paramètres</a>
            <a href="logout.php">Déconnexion</a>
          </div>
        </div>
      </header>
      <section class="content">
        <h1>Bienvenue sur votre dashboard</h1>
        <p>Contenu principal ici...</p>
      </section>
    </div>
  </div>

  <script>
    function toggleDropdown() {
      document.querySelector('.dropdown').classList.toggle('show');
    }
    // Optionnel: Fermer le dropdown si on clique ailleurs
    window.onclick = function(event) {
      if (!event.target.matches('.dropdown-btn')) {
        const dropdowns = document.getElementsByClassName("dropdown");
        for (let i = 0; i < dropdowns.length; i++) {
          const openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>
</body>
</html>
