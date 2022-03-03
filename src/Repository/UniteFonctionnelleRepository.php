<?php

namespace App\Repository;

use App\Entity\UniteFonctionnelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UniteFonctionnelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method UniteFonctionnelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method UniteFonctionnelle[]    findAll()
 * @method UniteFonctionnelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UniteFonctionnelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UniteFonctionnelle::class);
    }

    // /**
    //  * @return UniteFonctionnelle[] Returns an array of UniteFonctionnelle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UniteFonctionnelle
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
