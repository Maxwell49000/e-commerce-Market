<div class="main-content">
    <h1 class="page-title">Produits de la catégorie</h1>

    <?php if (!empty($produits)): ?>
        <div class="product-container">
            <?php foreach ($produits as $produit): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['nom_produit']) ?>" class="product-image">
                    <div class="product-info">
                        <h2 class="product-name"><?= htmlspecialchars($produit['nom_produit']) ?></h2>
                        <p><strong>Prix :</strong> <?= htmlspecialchars($produit['prix']); ?> €</p>
                        <p><strong>Quantité :</strong> <?= htmlspecialchars($produit['quantite']) ?></p>
                        <p class="description"><?= htmlspecialchars($produit['description']) ?></p>
                        <a href="index.php?controller=Produit&action=show&id=<?= htmlspecialchars($produit['id_produit']) ?>" class="btn btn-primary">Voir plus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun produit trouvé dans cette catégorie.</p>
    <?php endif; ?>

    <!-- Retour à la liste des produits sous forme de bouton -->
    <a href="index.php?controller=Produit&action=getProducts" class="btn btn-secondary">Retour à la liste des produits</a>
</div>