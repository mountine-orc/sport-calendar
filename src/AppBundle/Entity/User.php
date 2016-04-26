<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use CalendarBundle\Entity\Exercise;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="CalendarBundle\Entity\Exercise", mappedBy="user")
     */
    private $exercise;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->exercise = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     *
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return mixed
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            ) = unserialize($serialized);
    }

    /**
     * Get id
     *
     * @return integer
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
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Add exercise
     *
     * @param Exercise $exercise
     *
     * @return User
     */
    public function addExercise(Exercise $exercise)
    {
        $this->exercise[] = $exercise;

        return $this;
    }

    /**
     * Remove exercise
     *
     * @param Exercise $exercise
     */
    public function removeExercise(Exercise $exercise)
    {
        $this->exercise->removeElement($exercise);
    }

    /**
     * Get exercise
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExercise()
    {
        return $this->exercise;
    }
}
