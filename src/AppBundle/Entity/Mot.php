<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mot
 *
 * @ORM\Table(name="mot")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MotRepository")
 */
class Mot
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
     * @ORM\Column(name="mot_valeur", type="string", length=255, nullable=false)
     */
    private $motValeur;

    /**
       * @var \AppBundle\Entity\Grammer
       *
       * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Grammer")
       * @ORM\JoinColumns({
       *   @ORM\JoinColumn(name="mot_grammer", referencedColumnName="id")
       * })
       */
    private $motGrammer;


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
     * Set motValeur
     *
     * @param string $motValeur
     *
     * @return Mot
     */
    public function setMotValeur($motValeur)
    {
        $this->motValeur = $motValeur;

        return $this;
    }

    /**
     * Get motValeur
     *
     * @return string
     */
    public function getMotValeur()
    {
        return $this->motValeur;
    }



        /**
         * Set motGrammer
         *
         * @param integer $motGrammer
         *
         * @return Mot
         */
        public function setMotGrammer($motGrammer)
        {
            $this->motGrammer = $motGrammer;

            return $this;
        }

        /**
         * Get motGrammer
         *
         * @return int
         */
        public function getMotGrammer()
        {
            return $this->motGrammer;
        }
}
