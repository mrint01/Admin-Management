<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fichier
 *
 * @ORM\Table(name="fichier")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FichierRepository")
 */
class Fichier
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
     * @ORM\Column(name="fichier_url", type="string", length=255)
     */
    private $fichierUrl;

    /**
     * @var int
     *
     * @ORM\Column(name="fichier_traite", type="integer")
     */
    private $fichierTraite;


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
     * Set fichierUrl
     *
     * @param string $fichierUrl
     *
     * @return Fichier
     */
    public function setFichierUrl($fichierUrl)
    {
        $this->fichierUrl = $fichierUrl;

        return $this;
    }

    /**
     * Get fichierUrl
     *
     * @return string
     */
    public function getFichierUrl()
    {
        return $this->fichierUrl;
    }

    /**
     * Set fichierTraite
     *
     * @param integer $fichierTraite
     *
     * @return Fichier
     */
    public function setFichierTraite($fichierTraite)
    {
        $this->fichierTraite = $fichierTraite;

        return $this;
    }

    /**
     * Get fichierTraite
     *
     * @return int
     */
    public function getFichierTraite()
    {
        return $this->fichierTraite;
    }
}
