<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttendanceRepository")
 */
class Attendance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $morningHour;

    /**
     * @ORM\Column(type="datetime")
     */
    private $afternoonHour;

    /**
     * @ORM\Column(type="integer")
     */
    private $delay;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMorningHour(): ?\DateTimeInterface
    {
        return $this->morningHour;
    }

    public function setMorningHour(\DateTimeInterface $morningHour): self
    {
        $this->morningHour = $morningHour;

        return $this;
    }

    public function getAfternoonHour(): ?\DateTimeInterface
    {
        return $this->afternoonHour;
    }

    public function setAfternoonHour(\DateTimeInterface $afternoonHour): self
    {
        $this->afternoonHour = $afternoonHour;

        return $this;
    }

    public function getDelay(): ?int
    {
        return $this->delay;
    }

    public function setDelay(int $delay): self
    {
        $this->delay = $delay;

        return $this;
    }
}
