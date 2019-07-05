<?php

namespace App\Service;

class DelayService
{
    public function isCheckinAllowed(\DateTime $date)
    {
        return $this->isMorningCheckin($date) || $this->isAfternoonCheckin($date);
    }

    public function isMorningCheckin(\DateTime $date)
    {
        return $date >= $this->getMorningMinDelay($date) && $date < $this->getMorningMaxDelay($date);
    }

    public function isAfternoonCheckin(\DateTime $date)
    {
        return $date >= $this->getAfternoonMinDelay($date) && $date < $this->getAfternoonMaxDelay($date);
    }

    public function getMorningMinDelay(\DateTime $date): \DateTime
    {
        return new \DateTime($date->format('Y-m-d 09:05:00'));
    }

    public function getMorningMaxDelay(\DateTime $date): \DateTime
    {
        return new \DateTime($date->format('Y-m-d 12:00:00'));
    }

    public function getAfternoonMinDelay(\DateTime $date): \DateTime
    {
        return new \DateTime($date->format('Y-m-d 14:05:00'));
    }

    public function getAfternoonMaxDelay(\DateTime $date): \DateTime
    {
        return new \DateTime($date->format('Y-m-d 18:00:00'));
    }
}
