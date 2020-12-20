<?php

namespace App\Repository;

use App\Entity\Legislator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Legislator|null find($id, $lockMode = null, $lockVersion = null)
 * @method Legislator|null findOneBy(array $criteria, array $orderBy = null)
 * @method Legislator[]    findAll()
 * @method Legislator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LegislatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Legislator::class);
    }

    // /**
    //  * @return Legislator[] Returns an array of Legislator objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Legislator
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
