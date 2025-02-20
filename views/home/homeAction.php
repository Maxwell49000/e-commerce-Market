<!-- Page d'accueil: -->

<div class="container">
    <h1 class="titre">Bienvenue sur CEFii Market</h1>
    <!-- Hero Section -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Bienvenue chez CEFii Market</h1>
            <p class="lead">Un festival familial, culturel et festif à Angers.</p>
            <a href="#about" class="btn btn-outline-light btn-lg">En savoir plus</a>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">Qui sommes-nous ?</h2>
            <p class="lead">CEFii Market est une association joyeuse et conviviale basée à Angers. Chaque année, nous organisons le festival "Festiv'All-en-Scène" qui rassemble toutes les générations dans une ambiance festive et inclusive.</p>
        </div>
    </section>

    <!-- Program Section -->
    <section id="program" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Au programme</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <a class="lien" href="index.php?controller=Programmation&action=eventShow&id=1"><img src="..//public/IMG/concert.jpg" class="card-img-top" alt="Concerts"></a>
                        <div class="card-body">
                            <h5 class="card-title">Concerts</h5>
                            <p class="card-text">Des performances musicales pour tous les goûts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <a class="lien" href="index.php?controller=Programmation&action=eventShow&id=2"><img src="..//public/IMG/atelier.jpg" class="card-img-top" alt="Ateliers artistiques"></a>
                        <div class="card-body">
                            <h5 class="card-title">Ateliers artistiques</h5>
                            <p class="card-text">Exprimez votre créativité avec nos ateliers variés.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <a class="lien" href="index.php?controller=Programmation&action=eventShow&id=4"><img src="..//public/IMG/animation.png" class="card-img-top" alt="Animation"></a>
                        <div class="card-body">
                            <h5 class="card-title">Animations</h5>
                            <p class="card-text">Des animations pour occuper petits et grands.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <a class="lien" href="index.php?controller=Programmation&action=eventShow&id=3"><img src="..//public/IMG/spectacle.jpg" class="card-img-top" alt="Spectacles"></a>
                        <div class="card-body">
                            <h5 class="card-title">Spectacles</h5>
                            <p class="card-text">Découvrez des spectacles à couper le souffle!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">Contactez-nous</h2>
            <p class="para">Vous souhaitez participer ou avoir plus d'informations ? Contactez-nous dès maintenant !</p>
            <a href="mailto:CEFii@Market.fr" class="btn btn-outline-light btn-lg">Envoyer un email</a>
        </div>
    </section>
    <!-- Popup de consentement aux cookies -->
    <!-- Popup de consentement aux cookies -->
    <div id="cookiePopup" class="cookie-popup">
        <div class="cookie-content">
            <p class="para">Ce site utilise des cookies pour vous garantir la meilleure expérience. En continuant à naviguer, vous acceptez l'utilisation de cookies.</p>
            <button id="acceptCookies" class="btn btn-outline-light btn-lg">Accepter</button>
            <button id="rejectCookies" class="btn btn-outline-light btn-lg">Refuser</button>
        </div>
    </div>