require('dotenv').config(); // Charge les variables d'environnement depuis .env
const express = require('express');
const mysql = require('mysql2');
const app = express();
const port = process.env.API_PORT;

// Créer un pool de connexions à la base de données en utilisant les variables d'environnement
const pool = mysql.createPool({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASS,
  database: process.env.DB_NAME,
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0
});

// Endpoint pour récupérer les catégories
app.get('/api/categories', (req, res) => {
  pool.query('SELECT * FROM categories', (err, results) => {
    if (err) {
      console.error(err);
      return res.status(500).json({ error: 'Erreur lors de la connexion à la base de données' });
    }
    res.json(results);
  });
});

// Démarrer le serveur
app.listen(port, () => {
  console.log(`Serveur en écoute sur le port ${port}`);
});
