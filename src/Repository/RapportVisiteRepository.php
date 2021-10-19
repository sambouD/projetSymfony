<?php

namespace App\Repository;

use App\Entity\RapportVisite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RapportVisite|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportVisite|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportVisite[]    findAll()
 * @method RapportVisite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportVisiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RapportVisite::class);
    }

    // /**
    //  * @return RapportVisite[] Returns an array of RapportVisite objects
    //  */
  
   public function NbRapportVisite()
    {
        return $this->createQueryBuilder('r')
            ->select('v.matricule', 'v.nom', 'count(r.id) as nbRapports') // Le nombre de rapports des visiteurs
            ->innerJoin('r.visiteur',  'v')
            ->orderBy('v.nom', 'ASC')
            ->groupBy('v.matricule','v.nom')
            ->getQuery()
            ->getResult()
        ;
    }
    
  
    public function PraticienNbRapport()
    {
        return $this->createQueryBuilder('r')
            ->select('p.nom','count(r.id) as praticienNbRapports') // Le nombre de rapports  des praticiens
            ->innerJoin('r.praticien',  'p')
            ->orderBy('p.nom', 'ASC')
            ->groupBy('p.nom')
            ->getQuery()
            ->getResult()
        ;
    }
   

    /*
    public function findOneBySomeField($value): ?RapportVisite
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
