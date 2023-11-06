<?php

namespace App\Repository;

use App\Entity\StockAccessory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StockAccessory>
 *
 * @method StockAccessory|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockAccessory|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockAccessory[]    findAll()
 * @method StockAccessory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockAccessoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockAccessory::class);
    }

//    /**
//     * @return StockAccessory[] Returns an array of StockAccessory objects
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

    public function findAccessorysOfUser(int $id): array
    {
        $em = $this->getEntityManager();
        $sub = $em->createQueryBuilder();

        $sub->select('p')
            ->from('App\Entity\Accessory', 'p')
            ->InnerJoin('p.stockAccessorys', 'sp')
            ->InnerJoin('sp.stockUser', 'u')
            ->andWhere('u.id = :id')
            ->setParameter('id', $id);

        $query = $sub->getQuery();
        return $query->getResult();
    }

//    public function findOneBySomeField($value): ?StockAccessory
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
