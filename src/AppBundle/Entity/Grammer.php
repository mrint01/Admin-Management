<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grammer
 *
 * @ORM\Table(name="grammer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GrammerRepository")
 */
class Grammer
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
     * @var string
     *
     * @ORM\Column(name="grammer_nom", type="string", length=255, nullable=false)
     */
    private $grammerNom;

    /**
       * @var \AppBundle\Entity\Activite
       *
       * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Activite")
       * @ORM\JoinColumns({
       *   @ORM\JoinColumn(name="grammer_activite", referencedColumnName="id")
       * })
       */
    private $grammerActivite;


    /**
     * Get grammer_id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set grammerNom
     *
     * @param string $grammerNom
     *
     * @return Grammer
     */
    public function setGrammerNom($grammerNom)
    {
        $this->grammerNom = $grammerNom;

        return $this;
    }

    /**
     * Get grammerNom
     *
     * @return string
     */
    public function getGrammerNom()
    {
        return $this->grammerNom;
    }

    /**
     * Set grammerActivite
     *
     * @param integer $grammerActivite
     *
     * @return Grammer
     */
    public function setGrammerActivite($grammerActivite)
    {
        $this->grammerActivite = $grammerActivite;

        return $this;
    }

    /**
     * Get grammerActivite
     *
     * @return integer
     */
    public function getGrammerActivite()
    {
        return $this->grammerActivite;
    }
}
