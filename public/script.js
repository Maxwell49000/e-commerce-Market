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
    // Vérifie si le consentement aux cookies a déjà été donné
    if (document.cookie.includes('cookieConsent=true')) {
        // Si le consentement est déjà donné, on ne montre pas la popup
        document.getElementById('cookiePopup').style.display = 'none';
        return; // Arrêter l'exécution du reste du script
    }

    // Si le consentement n'a pas encore été donné, on affiche la popup
    document.getElementById('cookiePopup').style.display = 'flex';

    // Action pour accepter les cookies
    document.getElementById('acceptCookies').addEventListener('click', function () {
        // Enregistre le consentement avec un cookie valide pour 1 an
        document.cookie = "cookieConsent=true; path=/; max-age=31536000"; // Cookie pour 1 an
        document.getElementById('cookiePopup').style.display = 'none'; // Cache la popup après acceptation
    });

    // Action pour refuser les cookies
    document.getElementById('rejectCookies').addEventListener('click', function () {
        // Enregistre le refus avec un cookie valide pour 1 an
        document.cookie = "cookieConsent=false; path=/; max-age=31536000"; // Cookie pour 1 an
        document.getElementById('cookiePopup').style.display = 'none'; // Cache la popup après refus
    });
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
    resultsContainer.style.visibility = 'visible';
    resultsContainer.style.opacity = '1';

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



document.addEventListener("DOMContentLoaded", function () {
    const title = "Bienvenue chez CEFii Market!";
    let i = 0;
    let h1 = document.getElementById("animated-title");

    function typeEffect() {
        if (i < title.length) {
            h1.textContent += title.charAt(i);
            i++;
            setTimeout(typeEffect, 100); // Vitesse d'affichage des lettres
        }
    }

    typeEffect();
});


document.addEventListener("DOMContentLoaded", () => {
    const elements = document.querySelectorAll('.hidden');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target); // Arrête l'observation après affichage
            }
        });
    }, { threshold: 0.2 });

    elements.forEach(el => observer.observe(el));
});

document.addEventListener("DOMContentLoaded", () => {
    const products = document.querySelectorAll('.product-card');


    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target); // Une fois visible, on arrête d'observer
            }
        });
    }, { threshold: 0.2 });

    products.forEach(product => observer.observe(product));
});

// Gestion ajout avis:
document.addEventListener("DOMContentLoaded", function () {
    // Récupérer le formulaire d'avis
    const reviewForm = document.getElementById("reviewForm");
    // Vérifier si le formulaire existe pour éviter les erreurs
    if (reviewForm) {
        // Ajoute un écouteur d'événement sur la soumission du formulaire
        reviewForm.addEventListener("submit", function (e) {
            // Empêcher le rechargement de la page
            e.preventDefault();

            // Créer un objet FormData contenant les données du formulaire
            const formData = new FormData(reviewForm);

            // Envoi de la requête AJAX en POST vers le contrôleur PHP en MVC
            fetch('index.php?controller=Avis&action=ajouterAvis', {
                method: 'POST',
                // Envoi des données du formulaire
                body: formData
            })
                .then(function (response) {
                    // Conversion de la réponse en JSON
                    return response.json();
                })
                .then(function (data) {
                    if (data.success) {
                        // Si l'ajout de l'avis est réussi affiche un message de succès
                        alert("Avis ajouté avec succès !");

                        // Fermer la modale (si elle est utilisée, ici avec Bootstrap)
                        var myModal = bootstrap.Modal.getInstance(document.getElementById('addReviewModal'));
                        myModal.hide();

                        // Recharger la page pour afficher le nouvel avis ajouté
                        location.reload();
                    } else {
                        // Afficher un message d'erreur
                        alert("Erreur : " + (data.error || "Une erreur est survenue"));
                    }
                })
                // Gestion des erreurs réseau ou serveur
                .catch(function (error) {
                    console.error("Erreur:", error);
                    alert("Erreur de connexion au serveur");
                });
        });
    }
});