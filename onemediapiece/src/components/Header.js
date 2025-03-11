import React from 'react';
import './Header.css';
import logo from '../assets/logo.png';

export default function Header() {
    return(
        <header className="header">
            <button className="btn menu">Menu</button>
            <img src={logo} alt="Logo" className="logo" />
            <button className="btn login">Se connecter</button>
        </header>
    )
}