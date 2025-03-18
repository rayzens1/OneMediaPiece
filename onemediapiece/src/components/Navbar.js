import React from 'react';
import './Navbar.css';

const categories = [
  'Sport',
  'Economie',
  'Société',
  'Culture',
  'Faits divers',
  'Etudiant',
  'Politique',
  'International'
];

const Navbar = () => { // Rendre les catégories dynamique en utilisant une liste de catégories

  const totalCategories = categories.length;
  
  return (
    <nav className="navbar">
      <div className="navbar-left">
        <a href="#a-la-une" className="nav-item">À la une</a>
        <a href="#en-continue" className="nav-item">En continue</a>
        <span className="separator"></span>
      </div>
      <div className="navbar-right"> 
        {Array.from({ length: totalCategories }).map((_, index) => (
          <a
            href={`#${categories[index]}`}
            className="nav-item"
          >{categories[index]}</a>
        ))}
      </div>
    </nav>
  );
};

export default Navbar;