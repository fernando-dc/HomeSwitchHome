<?php

namespace App\Repository;

use App\Entity\Pujas;
use App\Entity\Usuarios;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Pujas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pujas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pujas[]    findAll()
 * @method Pujas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PujasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pujas::class);
    }

    // /**
    //  * @return Pujas[] Returns an array of Pujas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pujas
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function pujasOrdenadasMontoUsuarioValido($id_subasta){
        return $this -> createQueryBuilder('p')
        
        ->innerJoin('p.idUsuario','usuarios')
        ->addSelect('usuarios')
        ->andWhere('p.idSubasta = :subasta')
        ->setParameter('subasta', $id_subasta)
        ->andWhere('usuarios.creditos > 0')
        ->orderBy('p.monto','DESC')
        ->getQuery()
        ->getResult()
        ;
        //->innerJoin('p', 'usuarios', 'u', 'p.email = u.email')
    }

    public function pujasOrdenadasMonto($id_subasta){
        return $this -> createQueryBuilder('p')
            ->andWhere('p.idSubasta = :subasta')
            ->setParameter('subasta',$id_subasta)
            ->orderBy('p.monto','DESC')
            ->getQuery()
            ->getResult()
            ;
    }
}
