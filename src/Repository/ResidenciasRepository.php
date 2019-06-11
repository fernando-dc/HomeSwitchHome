<?php

namespace App\Repository;

use App\Entity\Residencias;
use App\Entity\SemanasReserva;
use App\Entity\Direcciones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Residencias|null find($id, $lockMode = null, $lockVersion = null)
 * @method Residencias|null findOneBy(array $criteria, array $orderBy = null)
 * @method Residencias[]    findAll()
 * @method Residencias[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResidenciasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Residencias::class);
    }

    // /**
    //  * @return Residencias[] Returns an array of Residencias objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Residencias
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function reservasEnFecha($fecha){
        return $this->createQueryBuilder('r')
        ->andWhere(':fecha BETWEEN a.reservas.fecha_inicio AND a.reservas.fecha_fin')
        ->setParameter('fecha', $fecha)
        ->getQuery()
        ->getOneOrNullResult();
    }

    public function residenciasEnCiudad($ciudad){
        return $this->createQueryBuilder('r')
            ->innerJoin('r.idDireccion', 'd')
            ->addSelect('d')
            ->andWhere('r.idDireccion = d.idDireccion')
            ->andWhere('d.ciudad = :ciudad')
            ->setParameter('ciudad', $ciudad)
            ->getQuery()
            ->getResult();
    }
}
