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
    .create-article {
      background-color: #fff;
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .create-article h2 {
      margin-bottom: 20px;
      text-align: center;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    .form-group input[type="text"],
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .form-group input[type="file"] {
      border: none;
    }
    .radio-group {
      display: flex;
      gap: 20px;
      align-items: center;
    }
    .radio-group input[type="radio"] {
      margin-right: 5px;
    }
    button {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #3498db;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      cursor: pointer;
    }
    button:hover {
      background-color: #2980b9;
    }
    img {
        max-width: 200px;
        height: auto;
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
      <div class="create-article">
        <h2>Créer un article</h2>
        <form id="articleForm" action="submit_article.php" method="POST" enctype="multipart/form-data">
        <!-- Titre de l'article -->
        <div class="form-group">
            <label for="title">Titre de l'article :</label>
            <input type="text" id="title" name="title" placeholder="Entrez le titre" required>
        </div>
        
        <!-- Contenu de l'article -->
        <div class="form-group">
            <label for="content">Contenu de l'article :</label>
            <textarea id="content" name="content" rows="8" placeholder="Entrez le contenu de l'article" required></textarea>
        </div>
        
        <!-- Image d'illustration -->
        <div class="form-group">
            <label for="illustration">Image d'illustration :</label>
            <input type="file" id="illustration" name="illustration" accept="image/*" required>
            <img id="illustrationPreview" class="image-preview" alt="Prévisualisation Illustration" style="display: none;">
        </div>
        
        <!-- Image de couverture -->
        <div class="form-group">
            <label for="cover">Image de couverture :</label>
            <input type="file" id="cover" name="cover" accept="image/*" required>
            <img id="coverPreview" class="image-preview" alt="Prévisualisation Couverture" style="display: none;">
        </div>
        
        <!-- Visibilité -->
        <div class="form-group">
            <label>Visibilité :</label>
            <div class="radio-group">
            <div>
                <input type="radio" id="public" name="visibility" value="public" checked>
                <label for="public">Public</label>
            </div>
            <div>
                <input type="radio" id="prive" name="visibility" value="prive">
                <label for="prive">Privé</label>
            </div>
            </div>
        </div>
        
        <!-- Bouton de soumission -->
        <button type="submit">Créer l'article</button>
        </form>
    </div>
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
    // Prévisualisation pour l'image d'illustration
    const illustrationInput = document.getElementById('illustration');
    const illustrationPreview = document.getElementById('illustrationPreview');

    illustrationInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
          illustrationPreview.src = event.target.result;
          illustrationPreview.style.display = 'block';
        }
        reader.readAsDataURL(file);
      }
    });

    // Prévisualisation pour l'image de couverture
    const coverInput = document.getElementById('cover');
    const coverPreview = document.getElementById('coverPreview');

    coverInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
          coverPreview.src = event.target.result;
          coverPreview.style.display = 'block';
        }
        reader.readAsDataURL(file);
      }
    });
    document.getElementById('articleForm').addEventListener('submit', function(e) {
      e.preventDefault();

      const form = e.target;
      const formData = new FormData(form);

      fetch('submit_article.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert(data.success);
          form.reset();
          illustrationPreview.style.display = 'none';
          coverPreview.style.display = 'none';
        } else if (data.error) {
          alert('Erreur: ' + data.error);
        }
      })
      .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur est survenue.');
      });
    });
  </script>
</body>
</html>
