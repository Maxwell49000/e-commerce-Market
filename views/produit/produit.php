<title><?= htmlspecialchars($produit['nom_produit']); ?></title>

<div class="product-container">
    <div class="product-card">
        <img src="<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['nom_produit']) ?>">
        <div class="product-info">
            <h2><?= htmlspecialchars($produit['nom_produit']); ?></h2>
            <p><strong>Prix :</strong> <?= htmlspecialchars($produit['prix']); ?> €</p>
            <p><strong>Quantité :</strong> <?= htmlspecialchars($produit['quantite']) ?></p>
            <p><strong>Catégorie :</strong> <?= htmlspecialchars($produit['nom_categorie']) ?></p>
            <p class="description"><?= htmlspecialchars($produit['description']) ?></p>
        </div>
        <a href="index.php?controller=Produit&action=getProducts" class="btn-back">Retour à la liste des produits</a>
    </div>
</div>

<!-- Section des avis -->
<h3>Avis :</h3>
<?php if (!empty($avis)): ?>
    <div class="reviews-container">
        <?php foreach ($avis as $avisItem): ?>
            <div class="review">
                <div class="review-header">
                    <strong class="author"><?= htmlspecialchars($avisItem['auteur']) ?></strong>
                    <span class="rating"><?= $avisItem['note'] ?>/5</span>
                </div>
                <div class="review-body">
                    <p class="comment"><?= htmlspecialchars($avisItem['commentaire']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucun avis pour ce produit.</p>
<?php endif; ?>