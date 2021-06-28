<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activite
 *
 * @ORM\Table(name="activite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActiviteRepository")
 */
class Activite
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
     * @ORM\Column(name="activite_nom", type="string", length=255)
     */
    private $activite;


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
     * Set activite
     *
     * @param string $activite
     *
     * @return Activite
     */
    public function setActivite($activite)
    {
        $this->activite = $activite;

        return $this;
    }

    /**
     * Get activite
     *
     * @return string
     */
    public function getActivite()
    {
        return $this->activite;
    }

    public function __toString()
    {
        return (string) $this->activite;
    }

}
