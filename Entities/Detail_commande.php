<?php
// Class Detail_commande:

class Detail_commande
{
    private $id_detail_commande;
    private $id_commande;
    private $id_produit;
    private $quantite;
    private $prix_unitaire;

    /**
     * Get the value of id_detail_commande
     */
    public function getId_detail_commande()
    {
        return $this->id_detail_commande;
    }

    /**
     * Set the value of id_detail_commande
     *
     * @return  self
     */
    public function setId_detail_commande($id_detail_commande)
    {
        $this->id_detail_commande = $id_detail_commande;

        return $this;
    }

    /**
     * Get the value of id_commande
     */
    public function getId_commande()
    {
        return $this->id_commande;
    }

    /**
     * Set the value of id_commande
     *
     * @return  self
     */
    public function setId_commande($id_commande)
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    /**
     * Get the value of id_produit
     */
    public function getId_produit()
    {
        return $this->id_produit;
    }

    /**
     * Set the value of id_produit
     *
     * @return  self
     */
    public function setId_produit($id_produit)
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    /**
     * Get the value of quantite
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set the value of quantite
     *
     * @return  self
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get the value of prix_unitaire
     */
    public function getPrix_unitaire()
    {
        return $this->prix_unitaire;
    }

    /**
     * Set the value of prix_unitaire
     *
     * @return  self
     */
    public function setPrix_unitaire($prix_unitaire)
    {
        $this->prix_unitaire = $prix_unitaire;

        return $this;
    }
}
