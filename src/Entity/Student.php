<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
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
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sex;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $postal_adress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $postal_code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $town;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phone_number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $funding;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $insurance_company;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $number_of_insurance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $social_security_number;

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

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getPostalAdress(): ?string
    {
        return $this->postal_adress;
    }

    public function setPostalAdress(?string $postal_adress): self
    {
        $this->postal_adress = $postal_adress;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(?string $postal_code): self
    {
        $this->postal_code = $postal_code;

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
        return $this->phone_number;
    }

    public function setPhoneNumber(?int $phone_number): self
    {
        $this->phone_number = $phone_number;

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
        return $this->insurance_company;
    }

    public function setInsuranceCompany(?string $insurance_company): self
    {
        $this->insurance_company = $insurance_company;

        return $this;
    }

    public function getNumberOfInsurance(): ?string
    {
        return $this->number_of_insurance;
    }

    public function setNumberOfInsurance(?string $number_of_insurance): self
    {
        $this->number_of_insurance = $number_of_insurance;

        return $this;
    }

    public function getSocialSecurityNumber(): ?string
    {
        return $this->social_security_number;
    }

    public function setSocialSecurityNumber(?string $social_security_number): self
    {
        $this->social_security_number = $social_security_number;

        return $this;
    }
}
