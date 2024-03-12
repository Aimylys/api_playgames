<?php

namespace App\Repository;

use App\Entity\ScoreTotal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ScoreTotal>
 *
 * @method ScoreTotal|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScoreTotal|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScoreTotal[]    findAll()
 * @method ScoreTotal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScoreTotalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ScoreTotal::class);
    }

//    /**
//     * @return ScoreTotal[] Returns an array of ScoreTotal objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ScoreTotal
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
