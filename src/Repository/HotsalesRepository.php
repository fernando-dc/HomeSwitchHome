<?php

namespace App\Repository;

use App\Entity\Hotsales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Hotsales|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hotsales|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hotsales[]    findAll()
 * @method Hotsales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotsalesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Hotsales::class);
    }

    // /**
    //  * @return Hotsales[] Returns an array of Hotsales objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hotsales
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function unaHotsale(){
        return $this->createQueryBuilder('h')
            ->innerJoin('h.idSemana', 's')
            ->addSelect('s')
            ->andWhere('h.idSemana = s.idSemana')
            ->andWhere('s.idUsuario is not null')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
