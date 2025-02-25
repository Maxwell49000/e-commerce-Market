<div class="main-content">
    <div class="product-container">
        <?php foreach ($products as $product): ?>
            <div class="product-card hidden">
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['nom_produit']) ?>">
                <div class="product-info">
                    <h2><?= htmlspecialchars($product['nom_produit']); ?></h2>
                    <p><strong>Prix :</strong> <?= htmlspecialchars($product['prix']); ?> €</p>
                    <p><strong>Quantité :</strong> <?= htmlspecialchars($product['quantite']) ?></p>
                    <p><strong>Catégorie :</strong> <?= htmlspecialchars($product['nom_categorie']) ?></p>
                    <p class="description"><?= htmlspecialchars($product['description']) ?></p>
                    <a href="index.php?controller=Produit&action=show&id=<?= htmlspecialchars($product['id_produit']); ?>" class="btn">Voir plus</a>


                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>