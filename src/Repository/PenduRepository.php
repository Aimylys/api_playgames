<?php

namespace App\Repository;

use App\Entity\Pendu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pendu>
 *
 * @method Pendu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pendu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pendu[]    findAll()
 * @method Pendu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PenduRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pendu::class);
    }

//    /**
//     * @return Pendu[] Returns an array of Pendu objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Pendu
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
