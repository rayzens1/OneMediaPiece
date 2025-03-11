import React from 'react';
import './Mention.css';

const Mention = () => {
  return (
    <div className="mention-wrapper">
        <p>© OneMediaPiece</p>
        <div>
            <ul className="mention-list">
                <ul><a href="#nous-ecrire" target="_blank" rel="noopener noreferrer">Nous écrire</a></ul>
                <ul><a href="#qui-sommes-nous-?" target="_blank" rel="noopener noreferrer">Qui sommes nous ?</a></ul>
                <ul><a href="#cgu" target="_blank" rel="noopener noreferrer">CGU</a></ul>
                <ul><a href="#politique-de-confidentialité" target="_blank" rel="noopener noreferrer">Politique de confidentialité</a></ul>
                <ul><a href="#gestion-des-cookies" target="_blank" rel="noopener noreferrer">Gestion des cookies</a></ul>
                <ul><a href="#espace-pro" target="_blank" rel="noopener noreferrer">Espace pro</a></ul>
                <ul><a href="#espace-presse" target="_blank" rel="noopener noreferrer">Espace presse</a></ul>
            </ul>
        </div>
    </div>
  );
};

export default Mention;
