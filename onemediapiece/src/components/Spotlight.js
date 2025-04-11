import {React, useEffect, useState} from 'react';
import './Spotlight.css';

// const articleId = 0;
// const articleTitle = `Comment la direction de Stéphane Plaza immobilier tente de faire oublier… Stéphane Plaza !` ;
// const articleTeaser = `En faisant appel de sa condamnation, l’ex-animateur risque de relancer les tensions avec les franchisés. Surtout au moment où la direction essaie de trouver des solutions pour relancer l’activité des agences.`;

const Spotlight = () => {
    const [article, setArticle] = useState(null);
  
    useEffect(() => {
      fetch('http://localhost:3001/api/articles')
        .then((response) => response.json())
        .then((data) => {
          if (data && data.length > 0) {
            setArticle(data[0]);
          }
        })
        .catch((error) => {
          console.error("Erreur lors du fetch :", error);
        });
    }, []);
  
    // Afficher un message de chargement tant que l'article n'est pas défini
    if (!article) {
      return <div>Chargement...</div>;
    }
  
    return (
      <div className="spotlight">
        <a href={`#article-${article.id}`} className="spotlight-url">
          <h2 className="spotlight-title">{article.title}</h2>
          <figure className="spotlight-cover-figure">
            {/* Ajustez le chemin selon votre structure de dossier */}
            <img
              className="spotlight-cover"
              // article/uploads/illustration_67f8ccc416ad64.95623492.jpg
              src={`${article.img_cover}`}
              alt="Spotlight Illustration"
            />
          </figure>
          <p className="spotlight-teaser">{article.resume}</p>
        </a>
      </div>
    );
  };
  
  
//   console.log(`../assets/article/${article.id}/cover.png`)
  
  export default Spotlight;