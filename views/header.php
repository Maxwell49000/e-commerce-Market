<!-- Header: -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();  // Démarre la session si elle n'est pas déjà démarrée
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/421fcfdcfb.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Swiper.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link
        href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>CEFii Market</title>
</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="index.php">CEFii Market</a>
                <ul class="navbar-nav ms-auto">
                    <!-- Si la variable _$SESSION['id_utilisateur'] est defini, afficher l'icone déconnection: -->
                    <?php if (isset($_SESSION['id_utilisateur'])): ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?controller=Utilisateur&action=disconnect"><i class="fa-solid fa-right-to-bracket"></i></a></li>

                        <!-- Si la variable _$SESSION['statut'] et que la variable _$SESSION['statut'] est égale à invité, afficher l'icone déconnection: -->
                    <?php elseif (isset($_SESSION['statut']) &&  $_SESSION['statut'] == 'invite'): ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?controller=Utilisateur&action=disconnect"><i class="fa-solid fa-right-to-bracket"></i></a></li>
                        <!-- Sinon afficher l'icone connection: -->
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?controller=Utilisateur&action=formConnect"><i class="fa-solid fa-user"></i></a></li>


                    <?php endif; ?>
                </ul>
                <div class="toggle">
                    <input type="checkbox" class="checkbox" id="darkMode">
                    <label for="darkMode" class="label">
                        <span class="moon">&#9790;</span>
                        <span class="sun">&#9788;</span>
                        <div class="circle"></div>
                    </label>
                </div>



                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <div class="navbar-search">
                            <form id="search-form" action="#" method="get">
                                <input type="text" id="search-input" name="search" placeholder="Rechercher des produits..." class="search-input">
                                <button type="submit" class="search-button">🔍</button>
                            </form>
                        </div>

                        <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?controller=Produit&action=getProducts">Produits</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?controller=Categorie&action=getCategory">Catégories</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?controller=Utilisateur&action=profil">Profil</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?controller=Panier&action=panierView" class="nav-link position-relative">
                                <i class="fas fa-shopping-cart"></i>
                                <?php if (!empty($_SESSION['panier'])): ?>
                                    <span class="position-absolute translate-middle badge rounded-pill bg-danger">
                                        <?php
                                        $totalItems = 0;
                                        foreach ($_SESSION['panier'] as $item) {
                                            $totalItems += $item['quantite'];
                                        }
                                        echo $totalItems;
                                        ?>
                                        <span class="visually-hidden">articles dans le panier</span>
                                    </span>
                                <?php endif; ?>
                            </a></li>
                    </ul>
                </div>
            </div>
            <!-- Flèche remontante -->
            <div id="scrollToTop" class="scroll-to-top">
                &#8679;
            </div>

        </nav>

        <main>
            <div id="search-results"></div>