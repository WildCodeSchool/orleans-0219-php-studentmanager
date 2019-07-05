<?php

namespace App\Repository;

use App\Entity\Presence;
use App\Entity\User;
use App\Service\AbsenceService;
use App\Service\DateService;
use App\Service\DelayService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class MonthlyRepository extends ServiceEntityRepository
{
    private $absenceService;

    private $delayService;

    public function __construct(RegistryInterface $registry, AbsenceService $AbsenceService, DelayService $DelayService)
    {
        parent::__construct($registry, Presence::class);
        $this->absenceService = $AbsenceService;
        $this->delayService = $DelayService;
    }

    /**
     * @param \DateTime $date
     * @param User $user
     * @return Presence
     */
    public function findByRecordingDoneMorningAbsence(\DateTime $date, User $user)
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.user', 'u')
            ->andWhere('p.date BETWEEN :dateMinMorningAbsence AND :dateMaxMorningAbsence')
            ->andWhere('u.id = :user')
            ->setParameters(
                [
                    'dateMinMorningAbsence' => $this->absenceService->getMorningMinAbsence($date),
                    'dateMaxMorningAbsence' => $this->absenceService->getMorningMaxAbsence($date),

                    'user' => $user->getId(),
                ]
            )
            ->getQuery();
        return $qb->getResult();
    }

    /**
     * @param \DateTime $date
     * @param User $user
     * @return Presence
     */
    public function findByRecordingDoneAfternoonAbsence(\DateTime $date, User $user)
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.user', 'u')
            ->andWhere('p.date BETWEEN :dateMinAfternoonAbsence AND :dateMaxAfternoonAbsence')
            ->andWhere('u.id = :user')
            ->setParameters(
                [
                    'dateMinAfternoonAbsence' => $this->absenceService->getAfternoonMinAbsence($date),
                    'dateMaxAfternoonAbsence' => $this->absenceService->getAfternoonMaxAbsence($date),
                    'user' => $user->getId(),
                ]
            )
            ->getQuery();
        return $qb->getResult();
    }

    /**
     * @param \Int
     * @param User $user
     * @return Presence
     */
    public function findByRecordingDoneMorningDelay(\DateTime $date, User $user)
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.user', 'u')
            ->andWhere('p.date BETWEEN :dateMinMorningDelay AND :dateMaxMorningDelay')
            ->andWhere('u.id = :user')
            ->setParameters(
                [
                    'dateMinMorningDelay' => $this->delayService->getMorningMinDelay($date),
                    'dateMaxMorningDelay' => $this->delayService->getMorningMaxDelay($date),
                    'user' => $user->getId(),
                ]
            )
            ->getQuery();
        return $qb->getResult();
    }

    /**
     * @param \DateTime $date
     * @param User $user
     * @return Presence
     */
    public function findByRecordingDoneAfternoonDelay(\DateTime $date, User $user)
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.user', 'u')
            ->andWhere('p.date BETWEEN :dateMinAfternoonDelay AND :dateMaxAfternoonDelay')
            ->andWhere('u.id = :user')
            ->setParameters(
                [
                    'dateMinAfternoonDelay' => $this->delayService->getAfternoonMinDelay($date),
                    'dateMaxAfternoonDelay' => $this->delayService->getAfternoonMaxDelay($date),
                    'user' => $user->getId(),
                ]
            )
            ->getQuery();
        return $qb->getResult();
    }
}
