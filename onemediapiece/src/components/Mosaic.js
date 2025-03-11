import React, { useState } from 'react';
import './Mosaic.css';

const articles = [
    { id: 1, url: '#tamere', image: 'https://img.lemde.fr/2025/03/11/483/0/5729/2864/2000/1000/75/0/7acec9e_ftp-import-images-1-dxyj4ldsmgl9-2025-03-11t102824z-1828396371-rc2xadaufl8o-rtrmadp-3-ukraine-crisis-attack-odesa.JPG', category: 'Economie', title: 'Voici l’intérieur du TGV du futur dévoilé par la SNCF' },
    { id: 2, url: '', image: 'https://www.leparisien.fr/resizer/Juj3r3PsEOf0Dv_bk65D0ftzEik=/932x582/cloudfront-eu-central-1.images.arcpublishing.com/leparisien/IW3KU2RBTJCDZMK34X3U4MAQPU.jpg', category: 'International', title: 'Guerre en Ukraine : le négociateur de Kiev évoque un début de discussion «constructif».' },
    { id: 3, url: '', image: 'https://dummyimage.com/1280x720/fff/aaa', category: 'Category 3', title: 'Title 3' },
    { id: 4, url: '', image: 'https://dummyimage.com/1280x720/fff/aaa', category: 'Category 4', title: 'Title 4' },
    { id: 5, url: '', image: 'https://dummyimage.com/1280x720/fff/aaa', category: 'Category 5', title: 'Title 5' },
    { id: 6, url: '', image: 'https://dummyimage.com/1280x720/fff/aaa', category: 'Category 6', title: 'Title 6' },
    { id: 7, url: '', image: 'https://dummyimage.com/1280x720/fff/aaa', category: 'Category 7', title: 'Title 7' },
    { id: 8, url: '', image: 'https://dummyimage.com/1280x720/fff/aaa', category: 'Category 8', title: 'Title 8' }
];

const Mosaic = () => {
    const articlesPerPage = 6;
    const totalPages = Math.ceil(articles.length / articlesPerPage);
    const [currentPage, setCurrentPage] = useState(0);

    const handlePrevious = () => {
        if (currentPage > 0) {
            setCurrentPage(currentPage - 1);
        }
    };

    const handleNext = () => {
        if (currentPage < totalPages - 1) {
            setCurrentPage(currentPage + 1);
        }
    };

    // On affiche seulement les articles de la page en cours.
    const displayedArticles = articles.slice(
        currentPage * articlesPerPage,
        (currentPage + 1) * articlesPerPage
    );

    return (
        <div className="mosaic-wrapper">
            <div className="mosaic-main-separator"></div>
            <div className="mosaic-container">
                {displayedArticles.map((article, index) => (
                    <div key={article.id} className="mosaic-item">
                        {index >= 2 && <div className="mosaic-separator"></div>}
                        <a href={article.url} className="mosaic-url">
                            <figure>
                                <img src={article.image} alt={article.title} />
                            </figure>
                            <p className="category">{article.category}</p>
                            <p className="title">{article.title}</p>
                        </a>
                    </div>
                ))}
            </div>
            <div className="pagination">
                <button className="pagination-arrow" onClick={handlePrevious} disabled={currentPage === 0}>
                    &lt;
                </button>
                <div className="pagination-dots">
                    {Array.from({ length: totalPages }).map((_, index) => (
                        <span
                            key={index}
                            className={`dot ${currentPage === index ? 'active' : ''}`}
                            onClick={() => setCurrentPage(index)}
                        ></span>
                    ))}
                </div>
                <button className="pagination-arrow" onClick={handleNext} disabled={currentPage === totalPages - 1}>
                    &gt;
                </button>
            </div>
            <div className="mosaic-main-separator"></div>
        </div>
    );
};

export default Mosaic;
