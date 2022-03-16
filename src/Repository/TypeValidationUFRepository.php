<?php

namespace App\Repository;

use App\Entity\TypeValidationUF;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeValidationUF|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeValidationUF|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeValidationUF[]    findAll()
 * @method TypeValidationUF[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeValidationUFRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeValidationUF::class);
    }

    // /**
    //  * @return TypeValidationUF[] Returns an array of TypeValidationUF objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeValidationUF
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
