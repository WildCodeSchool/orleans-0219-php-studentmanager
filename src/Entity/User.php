<?php
// src/Entity/User.php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=64, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=6)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with argon2i.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Attendance", mappedBy="user", orphanRemoval=true)
     */
    private $attendance;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Attendance", mappedBy="user", orphanRemoval=true)
     */
    private $attendances;

    public function __construct()
    {
        $this->roles = array('ROLE_USER');
        $this->attendance = new ArrayCollection();
        $this->attendances = new ArrayCollection();
    }

    // other properties and methods

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return Collection|Attendance[]
     */
    public function getAttendances(): Collection
    {
        return $this->attendances;
    }

    public function addAttendances(Attendance $attendances): self
    {
        if (!$this->attendances->contains($attendances)) {
            $this->attendances[] = $attendances;
            $attendances->setUser($this);
        }

        return $this;
    }

    public function removeAttendances(Attendance $attendances): self
    {
        if ($this->attendances->contains($attendances)) {
            $this->attendances->removeElement($attendances);
            // set the owning side to null (unless already changed)
            if ($attendances->getUser() === $this) {
                $attendances->setUser(null);
            }
        }

        return $this;
    }
}
