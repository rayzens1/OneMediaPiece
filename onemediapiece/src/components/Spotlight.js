import React from 'react';
import './Spotlight.css';

const articleId = 0;
const articleTitle = `Comment la direction de Stéphane Plaza immobilier tente de faire oublier… Stéphane Plaza !` ;
const articleTeaser = `En faisant appel de sa condamnation, l’ex-animateur risque de relancer les tensions avec les franchisés. Surtout au moment où la direction essaie de trouver des solutions pour relancer l’activité des agences.`;

const Spotlight = () => {
    return (
        <div className="spotlight">
            <a href="#spotlight" className='spotlight-url'>
                <h2 className="spotlight-title">{articleTitle}</h2>
                <figure className='spotlight-cover-figure'>
                    <img className="spotlight-cover" src={`assets/article/${articleId}/cover.png`} alt="Spotlight Illustration" />
                </figure>
                <p className="spotlight-teaser">{articleTeaser}</p>
            </a>
        </div>
    );
  };
  
  console.log(`../assets/article/${articleId}/cover.png`)
  
  export default Spotlight;