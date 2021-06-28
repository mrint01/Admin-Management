<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historique
 *
 * @ORM\Table(name="historique")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\historiqueRepository")
 */
class Historique
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="date_debut", type="string", length=255)
     */
    private $dateDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="date_fin", type="string", length=255)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="nbr_fichier_traite", type="string", length=255)
     */
    private $nbrFichierTraite;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateDebut
     *
     * @param string $dateDebut
     *
     * @return Historique
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return string
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param string $dateFin
     *
     * @return Historique
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return string
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set nbrFichierTraite
     *
     * @param string $nbrFichierTraite
     *
     * @return Historique
     */
    public function setNbrFichierTraite($nbrFichierTraite)
    {
        $this->nbrFichierTraite = $nbrFichierTraite;

        return $this;
    }

    /**
     * Get nbrFichierTraite
     *
     * @return string
     */
    public function getNbrFichierTraite()
    {
        return $this->nbrFichierTraite;
    }
}
