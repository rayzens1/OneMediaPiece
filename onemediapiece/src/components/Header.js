import React, {useState, useEffect} from 'react';
import './Header.css';
import logo from '../assets/logo.png';
import Navbar from './Navbar.js'

export default function Header() {
    const [isSticky, setIsSticky] = useState(false);

    const handleScroll = () => {
        setIsSticky(window.pageYOffset > 0);
    };

    const handleClickLogin = () => {
        window.location.href = '/login.html';
    };
    
    const handleClickLogo = () => {
        window.location.href = '/';
    };

    useEffect(() => {
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    return(
        <div className={`header-wrapper ${isSticky ? 'sticky' : ''}`}>
            <header className="header">
                <button className="btn menu">Menu</button>
                <img src={logo} alt="Logo" className="logo" onClick={handleClickLogo} />
                <button className="btn login" onClick={handleClickLogin}>Se connecter</button>
            </header>
            <Navbar />
        </div>
    )
}