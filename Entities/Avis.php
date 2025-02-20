<?php
// Class Avis:

class Avis
{

    private $id_avis;
    private $id_utilisateur;
    private $id_produit;
    private $note;
    private $commentaire;
    private $date_avis;

    /**
     * Get the value of id_avis
     */
    public function getId_avis()
    {
        return $this->id_avis;
    }

    /**
     * Set the value of id_avis
     *
     * @return  self
     */
    public function setId_avis($id_avis)
    {
        $this->id_avis = $id_avis;

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
     * Get the value of note
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of commentaire
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set the value of commentaire
     *
     * @return  self
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get the value of date_avis
     */
    public function getDate_avis()
    {
        return $this->date_avis;
    }

    /**
     * Set the value of date_avis
     *
     * @return  self
     */
    public function setDate_avis($date_avis)
    {
        $this->date_avis = $date_avis;

        return $this;
    }
}
