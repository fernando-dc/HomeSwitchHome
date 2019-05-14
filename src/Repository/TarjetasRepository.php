<?php

namespace App\Repository;

use App\Entity\Tarjetas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tarjetas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tarjetas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tarjetas[]    findAll()
 * @method Tarjetas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TarjetasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tarjetas::class);
    }

    // /**
    //  * @return Tarjetas[] Returns an array of Tarjetas objects
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
    public function findOneBySomeField($value): ?Tarjetas
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
