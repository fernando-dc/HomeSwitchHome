<?php

namespace App\Repository;

use App\Entity\Direcciones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Direcciones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Direcciones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Direcciones[]    findAll()
 * @method Direcciones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DireccionesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Direcciones::class);
    }

    // /**
    //  * @return Direcciones[] Returns an array of Direcciones objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Direcciones
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
