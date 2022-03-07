<?php

namespace App\Repository;

use App\Entity\AgentFinancement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AgentFinancement|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgentFinancement|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgentFinancement[]    findAll()
 * @method AgentFinancement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgentFinancementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgentFinancement::class);
    }

    // /**
    //  * @return AgentFinancement[] Returns an array of AgentFinancement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AgentFinancement
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
