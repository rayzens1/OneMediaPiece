import React, { useState, useEffect } from 'react';
import './ArticleDetail.css';

const ArticleDetail = ({ articleId, goBack }) => {
  const [article, setArticle] = useState(null);

  useEffect(() => {
    fetch(`http://localhost:3001/api/articles/${articleId}`)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Erreur lors de la récupération de l'article");
        }
        return response.json();
      })
      .then((data) => setArticle(data))
      .catch((error) => console.error('Erreur:', error));
  }, [articleId]);

  if (!article) {
    return <div>Chargement de l'article...</div>;
  }

  return (
    <div className="article-detail">
      <button onClick={goBack}>Retour</button>
      <h1>{article.title}</h1>
      <figure>
        <img src={`assets/article/${article.id}/cover.png`} alt={article.title} />
      </figure>
      <div className="content">
        {article.content}
      </div>
    </div>
  );
};

export default ArticleDetail;
