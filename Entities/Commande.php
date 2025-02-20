<?php
// Class Commande:

class Commande
{

    private $id_commande;
    private $id_utilisateur;
    private $date_commande;
    private $total;
    private $statut_commande;

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
     * Get the value of id_utilisateur
     */
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @return  self
     */
    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    /**
     * Get the value of date_commande
     */
    public function getDate_commande()
    {
        return $this->date_commande;
    }

    /**
     * Set the value of date_commande
     *
     * @return  self
     */
    public function setDate_commande($date_commande)
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    /**
     * Get the value of total
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     *
     * @return  self
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get the value of statut_commande
     */
    public function getStatut_commande()
    {
        return $this->statut_commande;
    }

    /**
     * Set the value of statut_commande
     *
     * @return  self
     */
    public function setStatut_commande($statut_commande)
    {
        $this->statut_commande = $statut_commande;

        return $this;
    }
}
