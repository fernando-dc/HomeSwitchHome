<?php

namespace App\Repository;

use App\Entity\SemanasReserva;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SemanasReserva|null find($id, $lockMode = null, $lockVersion = null)
 * @method SemanasReserva|null findOneBy(array $criteria, array $orderBy = null)
 * @method SemanasReserva[]    findAll()
 * @method SemanasReserva[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SemanasReservaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SemanasReserva::class);
    }

    // /**
    //  * @return SemanasReserva[] Returns an array of SemanasReserva objects
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
    public function findOneBySomeField($value): ?SemanasReserva
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
