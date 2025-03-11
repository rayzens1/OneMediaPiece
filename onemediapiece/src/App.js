import React from 'react';
import './App.css';
import Header from './components/Header.js';
import Navbar from './components/Navbar.js';
import Spotlight from './components/Spotlight.js';

function App() {
  return (
    <div className="App">
      <Header />
      <Navbar />
      <Spotlight />
    </div>
  );
}

export default App;
