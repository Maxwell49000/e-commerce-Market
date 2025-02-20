<h3 class="form-title">Ajouter un avis</h3>
<form action="index.php?controller=Avis&action=add" method="POST" class="review-form">
    <div class="rating-container">
        <label for="note" class="rating-label">Note :</label>
        <div class="rating">
            <span class="star" data-value="1">&#9733;</span>
            <span class="star" data-value="2">&#9733;</span>
            <span class="star" data-value="3">&#9733;</span>
            <span class="star" data-value="4">&#9733;</span>
            <span class="star" data-value="5">&#9733;</span>
        </div>
        <div id="rating-value" class="rating-value">0 / 5</div>
    </div>

    <input type="hidden" name="note" id="note" value="0">
    <textarea name="commentaire" rows="4" cols="50" placeholder="Votre commentaire" class="textarea"></textarea>

    <input type="hidden" name="id_produit" value="<?= htmlspecialchars($produit['id_produit']); ?>">
    <input type="hidden" name="id_utilisateur" value="<?= htmlspecialchars($_SESSION['id_utilisateur']); ?>">

    <button type="submit" class="submit-btn">Envoyer l'avis</button>
</form>

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