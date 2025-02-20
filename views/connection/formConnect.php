<div class="card-footer text-center">
    <a href="index.php?controller=Utilisateur&action=inscription" class="btn btn-outline-light btn-lg">Inscription</a>
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Connexion</h3>
                    <form action="index.php?controller=Utilisateur&action=connect" method="post" class="form">
                        <input type="hidden" name="type" value="classique">
                        <!-- Champ Nom -->
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom" required>
                        </div>
                        <!-- Champ Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email" required>
                        </div>
                        <!-- Champ Mot de passe -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                        </div>
                        <!-- Bouton Connexion -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-light btn-lg">Se connecter</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="index.php" class="btn btn-outline-light btn-lg">
                        <i class="fa-solid fa-arrow-left"></i> Retour à l'accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>