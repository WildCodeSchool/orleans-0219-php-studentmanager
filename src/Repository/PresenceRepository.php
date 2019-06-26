<?php

namespace App\Repository;

use App\Entity\Presence;
use App\Entity\User;
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
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Presence::class);
    }

/**
* @param $date
* @return Presence
*/
    public function recordingDoneMorning(\DateTime $date, User $user): array
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.user', 'u')
            ->andWhere('p.date BETWEEN :dateMinMorning AND :dateMaxMorning')
            ->andWhere('u.id = :user')
            ->setParameters(
                [
                    'dateMinMorning' => $date->format('Y-m-d 07:00:00'),
                    'dateMaxMorning' => $date->format('Y-m-d 12:00:00'),
                    'user' => $user->getId(),
                ]
            )
            ->getQuery();
        return $qb->execute();
    }

    /**
     * @param $date
     * @return Presence
     */
    public function recordingDoneAfternoon(\DateTime $date, User $user): array
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.user', 'u')
            ->andWhere('p.date BETWEEN :dateMinAfternoon AND :dateMaxAfternoon')
            ->andWhere('u.id = :user')
            ->setParameters(
                [
                    'dateMinAfternoon' => $date->format('Y-m-d 12:00:00'),
                    'dateMaxAfternoon' => $date->format('Y-m-d 14:00:00'),
                    'user' => $user->getId(),
                ]
            )
            ->getQuery();
        return $qb->execute();
    }
}
