<div class="container">
    <!-- Hero Section -->
    <header class="hidden">
        <h1 id="animated-title"></h1>

    </header>

    <!-- Carrousel Produits -->
    <div class="swiper mySwiper hidden">
        <div class="swiper-wrapper">
            <?php foreach ($products as $product): ?>
                <div class="swiper-slide">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['nom_produit']) ?>">
                    <div class="product-info">
                        <h2><?= htmlspecialchars($product['nom_produit']); ?></h2>
                        <p><strong>Prix :</strong> <?= htmlspecialchars($product['prix']); ?> €</p>
                        <p><strong>Catégorie :</strong> <?= htmlspecialchars($product['nom_categorie']) ?></p>
                        <a href="index.php?controller=Produit&action=show&id=<?= htmlspecialchars($product['id_produit']); ?>" class="btn">Voir plus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- Pagination -->
        <div class="swiper-pagination"></div>
    </div>

    <!-- Section Explore -->
    <section id="program" class="hidden">
        <h2 class="explore">Explorez</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <a href="index.php?controller=Produit&action=getProducts">
                        <img src="../public/IMG/produit.png" class="card-img-top" alt="Produits">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">Produits</h5>
                        <p class="card-text">Découvrez nos produits.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card hidden">
                    <a href="index.php?controller=Categorie&action=getCategory">
                        <img src="../public/IMG/categorie.png" class="card-img-top" alt="Catégories">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">Catégories</h5>
                        <p class="card-text">Recherchez par catégories.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popup Cookies -->
    <div id="cookiePopup" class="cookie-popup">
        <p>Ce site utilise des cookies pour améliorer votre expérience.</p>
        <button id="acceptCookies">Accepter</button>
        <button id="rejectCookies">Refuser</button>
    </div>
</div>