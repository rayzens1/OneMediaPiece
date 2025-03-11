import React, {useState, useEffect} from 'react';
import './Header.css';
import logo from '../assets/logo.png';
import Navbar from './Navbar.js'

export default function Header() {
    const [isSticky, setIsSticky] = useState(false);

    const handleScroll = () => {
        setIsSticky(window.pageYOffset > 0);
    };

    useEffect(() => {
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    return(
        <div className={`header-wrapper ${isSticky ? 'sticky' : ''}`}>
            <header className="header">
                <button className="btn menu">Menu</button>
                <img src={logo} alt="Logo" className="logo" />
                <button className="btn login">Se connecter</button>
            </header>
            <Navbar />
        </div>
    )
}