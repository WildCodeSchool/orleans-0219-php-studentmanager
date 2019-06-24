<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 *
 */
class Student
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide")
     */
    private $birthday;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide")
     * @Assert\Length(max=255)
     * maxMessage = "Ce champs doit contenir maximum {value} caractères."
     */
    private $postalAdress;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\Length(min=5,max=15)
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide")
     * minMessage = "Ce champs doit contenir minimum {value} caractères."
     * maxMessage = "Ce champs doit contenir maximum {value} caractères."
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide")
     * @Assert\Length(max=100)
     * maxMessage = "Ce champs doit contenir maximum {value} caractères."
     */
    private $town;

    /**
     * @ORM\Column(type="string",length=20)
     * @Assert\Length(max=20)
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide")
     * maxMessage = "Ce champs doit contenir maximum {value} caractères."
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide")
     * @Assert\Length(max=255)
     * maxMessage = "Ce champs doit contenir maximum {value} caractères."
     */
    private $funding;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide")
     * @Assert\Length(max=255)
     * maxMessage = "Ce champs doit contenir maximum {value} caractères."
     */
    private $insuranceCompany;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide")
     * @Assert\Length(max=255)
     * maxMessage = "Ce champs doit contenir maximum {value} caractères."
     */
    private $insuranceNumber;

    /**
     * @ORM\Column(type="string", length=7,options={"fixed" = true}, nullable=true)
     * @Assert\Length(min=7,max=7)
     * exactMessage = "Ce champs doit contenir {{limit}} caractères."
     */
    private $poleEmploiId;

    /**
     * @ORM\Column(type="string", length=255 )
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide")
     * @Assert\Length(max=255)
     * maxMessage = "Ce champs doit contenir maximum {{limit}} caractères."
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide")
     * @Assert\Length(max=255)
     * maxMessage = "Ce champs doit contenir maximum {{limit}} caractères."
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=13, options={"fixed" = true})
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide")
     * @Assert\Length(min=13,max=13 )
     * exactMessage = "Ce champs doit contenir {{limit}} caractères."
     */
    private $socialSecurityNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getPostalAdress(): ?string
    {
        return $this->postalAdress;
    }

    public function setPostalAdress(?string $postalAdress): self
    {
        $this->postalAdress = $postalAdress;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(?string $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?int $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getFunding(): ?string
    {
        return $this->funding;
    }

    public function setFunding(?string $funding): self
    {
        $this->funding = $funding;

        return $this;
    }

    public function getInsuranceCompany(): ?string
    {
        return $this->insuranceCompany;
    }

    public function setInsuranceCompany(?string $insuranceCompany): self
    {
        $this->insuranceCompany = $insuranceCompany;

        return $this;
    }

    public function getInsuranceNumber(): ?string
    {
        return $this->insuranceNumber;
    }

    public function setInsuranceNumber(?string $insuranceNumber): self
    {
        $this->insuranceNumber = $insuranceNumber;

        return $this;
    }

    public function getPoleEmploiId(): ?string
    {
        return $this->poleEmploiId;
    }

    public function setPoleEmploiId(?string $poleEmploiId): self
    {
        $this->poleEmploiId = $poleEmploiId;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getSocialSecurityNumber(): ?string
    {
        return $this->socialSecurityNumber;
    }

    public function setSocialSecurityNumber(string $socialSecurityNumber): self
    {
        $this->socialSecurityNumber = $socialSecurityNumber;

        return $this;
    }
}
