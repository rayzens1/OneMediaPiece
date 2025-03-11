import React from 'react';
import './Navbar.css';

const Navbar = () => {
  return (
    <nav className="navbar">
      <div className="navbar-left">
        <a href="#a-la-une" className="nav-item">À la une</a>
        <a href="#en-continue" className="nav-item">En continue</a>
        <span className="separator"></span>
      </div>
      <div className="navbar-right">
        <a href="#sport" className="nav-item">Sport</a>
        <a href="#economie" className="nav-item">Economie</a>
        <a href="#societe" className="nav-item">Société</a>
        <a href="#culture" className="nav-item">Culture</a>
        <a href="#faits-divers" className="nav-item">Faits divers</a>
        <a href="#etudiant" className="nav-item">Etudiant</a>
        <a href="#politique" className="nav-item">Politique</a>
        <a href="#international" className="nav-item">International</a>
      </div>
    </nav>
  );
};

export default Navbar;