import React from 'react';
import './App.css';
import Header from './components/Header.js';
import Navbar from './components/Navbar.js';
import Spotlight from './components/Spotlight.js';
import Mosaic from './components/Mosaic.js';
import Footer from './components/Footer.js';
import Mention from './components/Mention.js';

function App() {
  return (
    <div className="App">
      <Header />
      <Spotlight />
      <Mosaic />
      <Footer />
      <Mention />
    </div>
  );
}

export default App;
