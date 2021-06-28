<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Indexe
 *
 * @ORM\Table(name="indexe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IndexeRepository")
 */

class Indexe
{
  /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
       * @var \AppBundle\Entity\Mot
       *
       * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Mot")
       * @ORM\JoinColumns({
       *   @ORM\JoinColumn(name="index_mot", referencedColumnName="id")
       * })
       */
    private $indexeMot;

    /**
       * @var \AppBundle\Entity\Fichier
       *
       * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Fichier")
       * @ORM\JoinColumns({
       *   @ORM\JoinColumn(name="index_fichier", referencedColumnName="id")
       * })
       */
    private $indexeFichier;


    /**
     * @var string
     *
     * @ORM\Column(name="index_activite", type="string", length=255, nullable=false)
     */
    private $act;

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
     * Set indexeMot
     *
     * @param integer $indexeMot
     *
     * @return Indexe
     */
    public function setIndexeMot($indexeMot)
    {
        $this->indexeMot = $indexeMot;

        return $this;
    }

    /**
     * Get indexeMot
     *
     * @return int
     */
    public function getIndexeMot()
    {
        return $this->indexeMot;
    }

    /**
     * Set indexeFichier
     *
     * @param integer $indexeFichier
     *
     * @return Indexe
     */
    public function setIndexeFichier($indexeFichier)
    {
        $this->indexeFichier = $indexeFichier;

        return $this;
    }

    /**
     * Get indexeFichier
     *
     * @return int
     */
    public function getIndexeFichier()
    {
        return $this->indexeFichier;
    }














    /**
     * Set act
     *
     * @param String $act
     *
     * @return Indexe
     */
    public function setIndexeAct($act)
    {
        $this->act = $act;

        return $this;
    }

    /**
     * Get act
     *
     * @return String
     */
    public function getIndexeAct()
    {
        return $this->act;
    }


}
