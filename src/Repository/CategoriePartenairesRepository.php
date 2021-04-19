<?php

namespace App\Repository;

use App\Entity\CategoriePartenaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoriePartenaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriePartenaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriePartenaires[]    findAll()
 * @method CategoriePartenaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriePartenairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoriePartenaires::class);
    }

    // /**
    //  * @return CategoriePartenaires[] Returns an array of CategoriePartenaires objects
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
    public function findOneBySomeField($value): ?CategoriePartenaires
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
