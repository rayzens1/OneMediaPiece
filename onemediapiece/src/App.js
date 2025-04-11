import React, { useState } from 'react';
import './App.css';
import Header from './components/Header.js';
import Spotlight from './components/Spotlight.js';
import Mosaic from './components/Mosaic.js';
import Footer from './components/Footer.js';
import Mention from './components/Mention.js';
import ArticleDetail from './components/ArticleDetail.js';

function App() {
  const [selectedArticle, setSelectedArticle] = useState(null);

  // Callback pour sélectionner un article
  const handleSelectArticle = (articleId) => {
    setSelectedArticle(articleId);
  };

  // Callback pour revenir à la vue d'accueil
  const handleGoBack = () => {
    setSelectedArticle(null);
  };

  return (
    <div className="App">
      <Header />
      {selectedArticle ? (
        // Affichage du détail de l'article et bouton de retour
        <ArticleDetail articleId={selectedArticle} goBack={handleGoBack} />
      ) : (
        // Vue d'accueil avec Spotlight et Mosaic
        <>
          <Spotlight onSelectArticle={handleSelectArticle} />
          <Mosaic onSelectArticle={handleSelectArticle} />
        </>
      )}
      <Footer />
      <Mention />
    </div>
  );
}

export default App;
