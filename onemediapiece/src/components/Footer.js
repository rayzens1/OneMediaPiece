import React from 'react';
import './Footer.css';
import logo from '../assets/logo.png';

const Footer = () => {
  return (
    <footer className="footer">
      <div className="footer-wrapper">
        <div className="footer-logo">
          <img src={logo} alt="Logo" />
        </div>
        {/* Réseaux sociaux à droite */}
        <div className="footer-socials">
          <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer">
            {/* SVG Facebook */}
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
              <path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 4.991 3.657 9.128 8.438 9.877v-6.988H7.898v-2.89h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.463h-1.26c-1.242 0-1.63.772-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
            </svg>
          </a>
          <a href="https://twitter.com" target="_blank" rel="noopener noreferrer">
            {/* SVG Twitter */}
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
              <path d="M22.46 6c-.77.35-1.6.59-2.46.69a4.3 4.3 0 0 0 1.88-2.37 8.59 8.59 0 0 1-2.72 1.04 4.28 4.28 0 0 0-7.29 3.9 12.15 12.15 0 0 1-8.82-4.47 4.27 4.27 0 0 0 1.32 5.71 4.24 4.24 0 0 1-1.94-.54v.06a4.28 4.28 0 0 0 3.43 4.19 4.29 4.29 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.6 8.6 0 0 1-5.33 1.84 8.59 8.59 0 0 1-1.02-.06A12.15 12.15 0 0 0 12 21c7.9 0 12.22-6.55 12.22-12.22 0-.19 0-.38-.01-.57A8.73 8.73 0 0 0 24 4.56a8.51 8.51 0 0 1-2.54.7z"/>
            </svg>
          </a>
          <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer">
            {/* SVG Instagram */}
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
              <path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm0 2h10c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3 3-3zm5 2.5A4.5 4.5 0 1 0 16.5 11 4.5 4.5 0 0 0 12 6.5zm0 2A2.5 2.5 0 1 1 9.5 11 2.5 2.5 0 0 1 12 8.5zm4.5-.75a1.25 1.25 0 1 1-1.25-1.25 1.25 1.25 0 0 1 1.25 1.25z"/>
            </svg>
          </a>
        </div>
      </div>
      <div className="mosaic-main-separator"></div>
    </footer>
  );
};

export default Footer;
