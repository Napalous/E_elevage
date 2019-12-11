<?php

namespace App\Repository;

use App\Entity\Bovin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Bovin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bovin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bovin[]    findAll()
 * @method Bovin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BovinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bovin::class);
    }

    // /**
    //  * @return Bovin[] Returns an array of Bovin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bovin
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
