<?php

namespace App\Repository;

use App\Entity\Subastas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Subastas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subastas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subastas[]    findAll()
 * @method Subastas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubastasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Subastas::class);
    }

    // /**
    //  * @return Subastas[] Returns an array of Subastas objects
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
    public function findOneBySomeField($value): ?Subastas
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
