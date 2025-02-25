<?php $moyenne = isset($moyenne) ? $moyenne : 0 ?>
<title><?= htmlspecialchars($produit['nom_produit']); ?></title>

<div class="product-container">
    <div class="product-card">
        <img src="<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['nom_produit']) ?>" class="product-image">
        <div class="product-info">
            <h2 class="product-name"><?= htmlspecialchars($produit['nom_produit']); ?></h2>
            <p><strong>Prix :</strong> <?= htmlspecialchars($produit['prix']); ?> €</p>
            <p><strong>Quantité :</strong> <?= htmlspecialchars($produit['quantite']) ?></p>
            <p><strong>Catégorie :</strong> <?= htmlspecialchars($produit['nom_categorie']) ?></p>
            <p class="description"><?= htmlspecialchars($produit['description']) ?></p>
        </div>
        <div class="product-actions">
            <a href="index.php?controller=Produit&action=getProducts" class="btn btn-secondary">Retour à la liste des produits</a>
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addReviewModal">
                Ajouter un avis
            </button>
            <a href="index.php?controller=Panier&action=ajouterArticle&id=<?= htmlspecialchars($produit['id_produit']) ?>" class="btn btn-primary">Ajouter au panier</a>
        </div>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#avisModal">
            Voir les avis
        </button>

    </div>
</div>
<!-- Modale des avis -->
<div class="modal fade" id="avisModal" tabindex="-1" aria-labelledby="avisModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="avisModalLabel">Avis sur <?= htmlspecialchars($produit['nom_produit']) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <?php if (!empty($avis)): ?>
                    <div class="reviews-container">
                        <?php foreach ($avis as $avisItem): ?>
                            <div class="review">
                                <div class="review-header">
                                    <strong class="author"><?= htmlspecialchars($avisItem['auteur']) ?></strong>
                                    <span class="rating">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <span class="star" style="color: <?= $i <= $avisItem['note'] ? '#ffcc00' : '#ddd'; ?>">&#9733;</span>
                                        <?php endfor; ?>
                                    </span>
                                </div>
                                <div class="review-body">
                                    <p class="comment"><?= htmlspecialchars($avisItem['commentaire']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-reviews">
                        <p>Aucun avis pour ce produit.</p>
                        <p class="no-reviews-note">Soyez le premier à laisser un avis !</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modale pour ajouter un avis -->
<div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReviewModalLabel">Ajouter un avis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form id="reviewForm">
                    <input type="hidden" name="id_produit" value="<?= htmlspecialchars($produit['id_produit']) ?>">
                    <!-- Système de notation par étoiles -->
                    <div class="mb-3">
                        <label for="note" class="form-label">Note (1 à 5)</label>
                        <div class="stars-container">
                            <span class="star" data-value="1">★</span>
                            <span class="star" data-value="2">★</span>
                            <span class="star" data-value="3">★</span>
                            <span class="star" data-value="4">★</span>
                            <span class="star" data-value="5">★</span>
                        </div>
                        <input type="hidden" name="note" id="note" value="0" required>
                        <div id="rating-value">0 / 5</div>
                    </div>

                    <div class="mb-3">
                        <label for="commentaire" class="form-label">Commentaire</label>
                        <textarea class="form-control" name="commentaire" id="commentaire" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Envoyer</button>
                </form>
                <div id="reviewMessage" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stars = document.querySelectorAll(".star");
        const hiddenInput = document.getElementById("note");
        const ratingValueDisplay = document.getElementById("rating-value");

        stars.forEach(star => {
            star.addEventListener("mouseover", function() {
                const ratingValue = this.getAttribute("data-value");
                highlightStars(ratingValue);
            });

            star.addEventListener("mouseout", function() {
                highlightStars(hiddenInput.value);
            });

            star.addEventListener("click", function() {
                const ratingValue = this.getAttribute("data-value");
                hiddenInput.value = ratingValue;
                ratingValueDisplay.textContent = ratingValue + " / 5"; // Afficher la note
                highlightStars(ratingValue);
            });
        });

        function highlightStars(rating) {
            stars.forEach(star => {
                const starValue = star.getAttribute("data-value");
                if (starValue <= rating) {
                    star.classList.add("selected");
                } else {
                    star.classList.remove("selected");
                }
            });
        }
    });
</script>