<div class="main-content">
    <div class="product-container">
        <?php foreach ($categorys as $category): ?>
            <div class="product-card">

                <div class="product-info">



                    <p><strong>Catégorie :</strong> <?= htmlspecialchars($category['nom_categorie']) ?></p>

                    <a href="index.php?controller=Categorie&action=showCat&id=<?= htmlspecialchars($category['id_categorie']); ?>" class="btn">Voir plus</a>


                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>