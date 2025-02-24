document.addEventListener("DOMContentLoaded", () => {
    // Fonction pour mettre à jour l'heure
    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const formattedTime = `${hours}:${minutes}:${seconds}`;

        // Affiche l'heure dans l'élément avec l'ID currentTime
        document.getElementById("currentTime").textContent = `Heure actuelle : ${formattedTime}`;
    }

    // Mettre à jour l'heure toutes les secondes
    setInterval(updateTime, 1000);

    // Appeler une première fois la fonction pour afficher l'heure immédiatement
    updateTime();
});


document.addEventListener('DOMContentLoaded', function () {
    // Vérifier si le consentement aux cookies a été donné
    if (!document.cookie.includes('cookieConsent=true')) {
        // Show the popup
        document.getElementById('cookiePopup').style.display = 'block';

        // Action when user accepts cookies
        document.getElementById('acceptCookies').addEventListener('click', function () {
            document.cookie = "cookieConsent=true; path=/"; // Set cookie
            document.getElementById('cookiePopup').style.display = 'none';
        });

        // Action when user rejects cookies
        document.getElementById('rejectCookies').addEventListener('click', function () {
            document.cookie = "cookieConsent=false; path=/"; // Set cookie
            document.getElementById('cookiePopup').style.display = 'none';
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    var scrollToTopButton = document.getElementById('scrollToTop');

    // Afficher la flèche de remontée lorsqu'on défile
    window.addEventListener('scroll', function () {
        if (window.scrollY > 150) { // Afficher la flèche si l'utilisateur a défilé plus de 300px
            scrollToTopButton.style.display = 'block';
        } else {
            scrollToTopButton.style.display = 'none';
        }
    });

    // Action lors du clic sur la flèche remontante
    scrollToTopButton.addEventListener('click', function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // Remontée en douceur
        });
    });
});


document.getElementById('search-form').addEventListener('submit', async function (event) {
    event.preventDefault(); // Empêche la soumission classique du formulaire

    const keyword = document.getElementById('search-input').value;
    console.log('Mot-clé:', keyword); // Log pour vérifier que le mot-clé est récupéré

    if (!keyword.trim()) {
        console.log('Aucun mot-clé entré');
        return; // Ne pas envoyer une requête vide
    }

    try {
        // Envoi de la requête à l'API
        const response = await fetch(`http://localhost:3000/produits/recherche?q=${encodeURIComponent(keyword)}`);
        console.log('Réponse de l\'API:', response); // Vérifiez si la réponse est bien reçue

        if (!response.ok) {
            throw new Error('Erreur lors de la recherche');
        }

        const produits = await response.json();
        console.log('Produits reçus:', produits); // Log pour vérifier les produits reçus

        // Affichage des résultats
        displayResults(produits);

    } catch (error) {
        console.error('Erreur lors de la recherche:', error);
    }
});

// Fonction pour afficher les résultats de recherche
function displayResults(produits) {
    const resultsContainer = document.getElementById('search-results');
    resultsContainer.innerHTML = ''; // Efface les anciens résultats

    if (produits.length === 0) {
        resultsContainer.innerHTML = '<p>Aucun produit trouvé.</p>';
        return;
    }

    produits.forEach(produit => {
        const productElement = document.createElement('div');
        productElement.classList.add('product-card');
        productElement.innerHTML = `
            <img src="${produit.image}" alt="${produit.nom_produit}" class="product-image">
            <h3>${produit.nom_produit}</h3>
            <p>Prix: ${produit.prix} €</p>
            <p>${produit.description}</p>
            <a href="index.php?controller=Produit&action=show&id=${produit.id_produit}" class="btn btn-outline-light btn-lg">Voir plus</a>
        `;
        resultsContainer.appendChild(productElement);
    });
}

document.addEventListener("DOMContentLoaded", function () {
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3, /* Nombre d'éléments visibles */
        spaceBetween: 20, /* Espace entre les éléments */
        loop: true, /* Boucle infinie */
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 2, /* 2 éléments sur tablette */
            },
            480: {
                slidesPerView: 1, /* 1 élément sur mobile */
            }
        }
    });
});


