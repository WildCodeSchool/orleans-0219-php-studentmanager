<?php

namespace App\Repository;

use App\Entity\Presence;
use App\Entity\User;
use App\Service\DateService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Presence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Presence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Presence[]    findAll()
 * @method Presence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresenceRepository extends ServiceEntityRepository
{

    private $dateService;

    public function __construct(RegistryInterface $registry, DateService $dateService)
    {
        parent::__construct($registry, Presence::class);
        $this->dateService = $dateService;
    }

    /**
     * @param \DateTime $date
     * @param User $user
     * @return Presence
     */
    public function findByRecordingDoneMorning(\DateTime $date, User $user)
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.user', 'u')
            ->andWhere('p.date BETWEEN :dateMinMorning AND :dateMaxMorning')
            ->andWhere('u.id = :user')
            ->setParameters(
                [
                    'dateMinMorning' => $this->dateService->getMorningMinDate($date),
                    'dateMaxMorning' => $this->dateService->getMorningMaxDate($date),
                    'user' => $user->getId(),
                ]
            )
            ->getQuery();
        return $qb->execute();
    }

    /**
     * @param \DateTime $date
     * @param User $user
     * @return Presence
     */
    public function findByRecordingDoneAfternoon(\DateTime $date, User $user)
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.user', 'u')
            ->andWhere('p.date BETWEEN :dateMinAfternoon AND :dateMaxAfternoon')
            ->andWhere('u.id = :user')
            ->setParameters(
                [
                    'dateMinAfternoon' => $this->dateService->getAfternoonMinDate($date),
                    'dateMaxAfternoon' => $this->dateService->getAfternoonMaxDate($date),
                    'user' => $user->getId(),
                ]
            )
            ->getQuery();
        return $qb->execute();
    }
}
