<?php
// Class Avis:

class Avis
{

    private $id_avis;
    private $commentaire;
    private $date_commentaire;


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
     * Get the value of date_commentaire
     */
    public function getDate_commentaire()
    {
        return $this->date_commentaire;
    }

    /**
     * Set the value of date_commentaire
     *
     * @return  self
     */
    public function setDate_commentaire($date_commentaire)
    {
        $this->date_commentaire = $date_commentaire;

        return $this;
    }
}
