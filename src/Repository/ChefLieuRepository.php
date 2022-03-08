<?php

namespace App\Repository;

use App\Entity\ChefLieu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChefLieu|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChefLieu|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChefLieu[]    findAll()
 * @method ChefLieu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChefLieuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChefLieu::class);
    }

    // /**
    //  * @return ChefLieu[] Returns an array of ChefLieu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ChefLieu
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
