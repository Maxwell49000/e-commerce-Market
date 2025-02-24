<?php

require_once 'Controller.php';

class CategorieController extends Controller
{
    private $apiBaseUrl = "http://localhost:3000/categorie/";

    public function getCategory()
    {
        $url = $this->apiBaseUrl;
        $response = file_get_contents($url);
        $categorys = json_decode($response, true);

        $this->render('categorie/displayCategorieAction', ['categorys' => $categorys]);
    }

    public function showCat($id)
    {
        // Assure-toi que l'URL est correctement formatée sans doublon
        $url = $this->apiBaseUrl . $id . "/produits";  // Retire le "categorie" redondant

        echo "URL générée: " . $url; // Pour vérifier l'URL générée

        $json = file_get_contents($url);
        $produits = json_decode($json, true);

        if (!$produits) {
            die("Aucun produit trouvé pour cette catégorie.");
        }

        // Charge la vue pour afficher les produits
        $this->render("produit/produit_par_categorie", ['produits' => $produits, 'categorieId' => $id]);
    }
}
