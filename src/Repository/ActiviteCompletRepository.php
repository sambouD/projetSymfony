<?php

namespace App\Repository;

use App\Entity\ActiviteComplet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActiviteComplet|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiviteComplet|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiviteComplet[]    findAll()
 * @method ActiviteComplet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteCompletRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActiviteComplet::class);
    }

    // /**
    //  * @return ActiviteComplet[] Returns an array of ActiviteComplet objects
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
    public function findOneBySomeField($value): ?ActiviteComplet
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
