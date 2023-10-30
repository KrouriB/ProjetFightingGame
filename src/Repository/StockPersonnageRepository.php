<?php

namespace App\Repository;

use App\Entity\StockPersonnage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StockPersonnage>
 *
 * @method StockPersonnage|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockPersonnage|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockPersonnage[]    findAll()
 * @method StockPersonnage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockPersonnageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockPersonnage::class);
    }

//    /**
//     * @return StockPersonnage[] Returns an array of StockPersonnage objects
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

//    public function findOneBySomeField($value): ?StockPersonnage
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
