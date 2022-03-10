<?php

namespace App\Repository;

use App\Entity\SousAction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SousAction|null find($id, $lockMode = null, $lockVersion = null)
 * @method SousAction|null findOneBy(array $criteria, array $orderBy = null)
 * @method SousAction[]    findAll()
 * @method SousAction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousActionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousAction::class);
    }

    // /**
    //  * @return SousAction[] Returns an array of SousAction objects
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
    public function findOneBySomeField($value): ?SousAction
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
