<?php

namespace App\Repository;

use App\Entity\Lait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Lait|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lait|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lait[]    findAll()
 * @method Lait[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LaitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lait::class);
    }

    // /**
    //  * @return Lait[] Returns an array of Lait objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lait
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
