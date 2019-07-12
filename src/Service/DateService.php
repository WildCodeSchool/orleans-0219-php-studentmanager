<?php

namespace App\Service;

class DateService
{

    public function isCheckinAllowed(\DateTime $date)
    {
        return $this->isMorningCheckin($date) || $this->isAfternoonCheckin($date);
    }

    public function isMorningCheckin(\DateTime $date)
    {
        return $date >= $this->getMorningMinDate($date) && $date < $this->getMorningMaxDate($date);
    }

    public function isAfternoonCheckin(\DateTime $date)
    {
        return $date >= $this->getAfternoonMinDate($date) && $date < $this->getAfternoonMaxDate($date);
    }

    public function getMorningMinDate(\DateTime $date): \DateTime
    {
        return new \DateTime($date->format('Y-m-d 07:00:00'));
    }

    public function getMorningMaxDate(\DateTime $date): \DateTime
    {
        return new \DateTime($date->format('Y-m-d 10:00:00'));
    }

    public function getAfternoonMinDate(\DateTime $date): \DateTime
    {
        return new \DateTime($date->format('Y-m-d 12:00:00'));
    }

    public function getAfternoonMaxDate(\DateTime $date): \DateTime
    {
        return new \DateTime($date->format('Y-m-d 15:00:00'));
    }
}
