<div class="container py-5">
    <!-- Titre -->
    <h1 class="pagesTitle text-center mb-5 text-uppercase fw-bold">Votre panier</h1>

    <?php if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])): ?>
        <?php $total = 0; ?>

        <!-- Contenu du panier -->
        <div class="row">
            <!-- Tableau des articles -->
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white text-center">
                        <h4 class="mb-0">Détails de votre panier</h4>
                    </div>
                    <div class="card-body p-0">
                        <!-- Vue Desktop : Tableau -->
                        <div class="table-responsive d-none d-md-block">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Prix</th>
                                        <th scope="col">Quantité</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($_SESSION['panier'] as $index => $article): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($article['nom'] ?? 'Nom indisponible'); ?></td>
                                            <td><?php echo htmlspecialchars($article['description'] ?? 'Description indisponible'); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($article['prix'] ?? 'Prix indisponible'); ?> €</td>
                                            <td class="text-center">
                                                <form method="post" action="index.php?controller=Panier&action=modifierQuantite" class="d-flex justify-content-center align-items-center">
                                                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                                                    <input type="number" name="quantite" value="<?php echo $article['quantite']; ?>" min="1" class="form-control form-control-sm text-center me-2" style="width: 70px;">
                                                    <button type="submit" class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="text-center"><?php echo $article['prix'] * $article['quantite']; ?> €</td>
                                            <td class="text-center">
                                                <a href="index.php?controller=Panier&action=supprimerArticle&id=<?php echo $index; ?>" class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $total += $article['prix'] * $article['quantite']; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Vue Mobile : Liste -->
                        <div class="d-block d-md-none">
                            <?php foreach ($_SESSION['panier'] as $index => $article): ?>
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($article['nom'] ?? 'Nom indisponible'); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($article['description'] ?? 'Description indisponible'); ?></p>
                                        <p class="card-text"><strong>Prix :</strong> <?php echo htmlspecialchars($article['prix'] ?? 'Prix indisponible'); ?> €</p>
                                        <p class="card-text">
                                            <strong>Quantité :</strong>
                                        <form method="post" action="index.php?controller=Panier&action=modifierQuantite" class="d-flex align-items-center">
                                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                                            <input type="number" name="quantite" value="<?php echo $article['quantite']; ?>" min="1" class="form-control form-control-sm text-center me-2" style="width: 70px;">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </form>
                                        </p>
                                        <p class="card-text"><strong>Total :</strong> <?php echo $article['prix'] * $article['quantite']; ?> €</p>
                                        <a href="index.php?controller=Panier&action=supprimerArticle&id=<?php echo $index; ?>" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Pied de page du tableau -->
                    <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                        <span class="fw-bold fs-5">Total du panier : <?php echo $total; ?> €</span>
                        <div>
                            <a href="index.php?controller=Panier&action=deletePanier" class="btn btn-danger me-2">
                                <i class="fas fa-trash-alt"></i> Vider le panier
                            </a>
                            <a href="index.php?controller=Panier&action=validerCommande" class="btn btn-success">
                                <i class="fas fa-check"></i> Valider la commande
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php else : ?>
        <!-- Panier vide -->
        <div class="alert alert-warning text-center my-5 shadow-sm" role="alert">
            <h4 class="alert-heading mb-3">Votre panier est vide</h4>
            <p>Ajoutez des produits à votre panier pour les voir apparaître ici.</p>
            <a href="index.php?controller=Produit&action=getProducts" class="btn btn-outline-primary mt-3">
                <i class="fas fa-shopping-basket"></i> Voir les produits
            </a>
        </div>
    <?php endif; ?>
</div>