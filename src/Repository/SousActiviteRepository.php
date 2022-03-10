<?php

namespace App\Repository;

use App\Entity\SousActivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SousActivite|null find($id, $lockMode = null, $lockVersion = null)
 * @method SousActivite|null findOneBy(array $criteria, array $orderBy = null)
 * @method SousActivite[]    findAll()
 * @method SousActivite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousActivite::class);
    }

    // /**
    //  * @return SousActivite[] Returns an array of SousActivite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SousActivite
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
