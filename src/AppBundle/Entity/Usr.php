<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * adm
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdminRepository")
 */
class Usr implements UserInterface
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
       * @var string le token qui servira lors de l'oubli de mot de passe
       * @ORM\Column(type="string", length=255, nullable=true)
       */
      protected $resetToken;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;




    /**
     * @var string
     *
     * @ORM\Column(name="nom_user", type="string", length=255)
     */
    private $username;



      /**
         * @var string
         *
         * @ORM\Column(name="activite", type="string", length=255)
         *
         *
         */
     private $activite;


    /**
     * @var string
     *
     * @ORM\Column(name="mot_pass", type="string", length=255)
     */
    private $password;



    /**
    * @var array
   * @ORM\Column(type="json_array" , nullable=true)
   */
  private $roles = [];


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
     * Set username
     *
     * @param string $username
     *
     * @return users
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }



    /**
     *
     *
     * @return array (Role|string)[] the user roles
     */

     public function getRoles()
   {
     $tempRoles = $this->roles;
      $tempRoles[] = 'ROLE_USER';

     return $tempRoles;

   }


   public function setRoles($roles)
   {
       $this->roles = $roles;

       return $this;
   }

    /**
     * Set activite
     *
     * @param string $activite
     *
     * @return users
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
    public function  getActivite()
    {
        return $this->activite;
    }









    /**
     * Set name
     *
     * @param string $name
     *
     * @return users
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function  getName()
    {
        return $this->name;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return users
     */
    public function setLastName($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function  getLastName()
    {
        return $this->lastname;
    }


    /**
     * Set email
     *
     * @param string $email
     *
     * @return users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function  getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getResetToken(): string
    {
        return $this->resetToken;
    }

    /**
     * @param string $resetToken
     */
    public function setResetToken(?string $resetToken): void
    {
        $this->resetToken = $resetToken;
    }


//////////////////////////
public function getSalt()
  {
      return null;
  }
public function getRole()
   {
       return [$this->getRoles()];
   }

   public function eraseCredentials()
   {
     return null;
   }



}
