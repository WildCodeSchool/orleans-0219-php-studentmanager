<?php

namespace App\Service;

class AbsenceService
{
    public function isCheckinAllowed(\DateTime $date)
    {
        return $this->notIsMorningCheckin($date) || $this->notIsAfternoonCheckin($date);
    }

    public function notIsMorningCheckin(\DateTime $date)
    {
        return $date >= $this->getMorningMinAbsence($date) && $date < $this->getMorningMaxAbsence($date);
    }

    public function notIsAfternoonCheckin(\DateTime $date)
    {
        return $date >= $this->getAfternoonMinAbsence($date) && $date < $this->getAfternoonMaxAbsence($date);
    }

    public function getMorningMinAbsence(\DateTime $date): \DateTime
    {
        return new \DateTime($date->format('Y-m-d 00:00:00'));
    }

    public function getMorningMaxAbsence(\DateTime $date): \DateTime
    {
        return new \DateTime($date->format('Y-m-d 12:00:00'));
    }

    public function getAfternoonMinAbsence(\DateTime $date): \DateTime
    {
        return $this->getMorningMaxAbsence($date);
    }

    public function getAfternoonMaxAbsence(\DateTime $date): \DateTime
    {
        return new \DateTime($date->format('Y-m-d 00:00:00'));
    }
}
