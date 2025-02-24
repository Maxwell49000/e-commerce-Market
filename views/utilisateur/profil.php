<?php if (!empty($message)): ?>
    <div class="alert alert-info text-center" role="alert">
        <?= htmlspecialchars($message); ?>
    </div>
<?php endif; ?>
<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-info" role="alert">
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php unset($_SESSION['message']); // Efface le message après affichage 
    ?>
<?php endif;


?>

<div class="container mt-4">
    <div class="row">
        <!-- Profil utilisateur -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4><i class="fas fa-user"></i> Mon Profil</h4>
                </div>
                <div class="card-body">
                    <p><strong>Nom :</strong> <?= htmlspecialchars($utilisateur['nom']) ?></p>
                    <p><strong>Email :</strong> <?= htmlspecialchars($utilisateur['email']) ?></p>
                </div>
            </div>
        </div>

        <!-- Section commandes -->
        <div class="col-md-12 mt-4">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h4><i class="fas fa-shopping-cart"></i> Mes Commandes</h4>
                </div>
                <div class="card-body">
                    <?php if (empty($commandes)): ?>
                        <p class="text-muted">Aucune commande passée.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Id_commande</th>
                                        <th>Date</th>
                                        <th>Nom du produit</th>
                                        <th>Image</th>
                                        <th>Quantité</th>
                                        <th>Prix unitaire</th>
                                        <th>Total</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($commandes as $commande): ?>
                                        <tr>
                                            <td><?= $commande->id_commande  ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($commande->date_commande)) ?></td>
                                            <td><?= htmlspecialchars($commande->nom_produit ?? 'Produit inconnu') ?></td>
                                            <td><img src="<?= htmlspecialchars($commande->image) ?>" class="img-fluid" style="width: 100px; height: 100px; object-fit: cover;"></td>
                                            <td><?= $commande->quantite ?></td>
                                            <td><?= $commande->prix_unitaire ?></td>
                                            <td><?= number_format($commande->total, 2, ',', ' ') ?> €</td>
                                            <td>
                                                <?php
                                                $statuts = [
                                                    'En attente' => 'warning',
                                                    'Validée' => 'info',
                                                    'Expédiée' => 'primary',
                                                    'Livrée' => 'success',
                                                    'Annulée' => 'danger'
                                                ];
                                                $badgeClass = $statuts[$commande->statut_commande] ?? 'secondary';
                                                ?>
                                                <span class="badge bg-<?= $badgeClass; ?>">
                                                    <?= $commande->statut_commande; ?>
                                                </span>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>