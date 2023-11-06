<?php

namespace App\Repository;

use App\Entity\StockWeapon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StockWeapon>
 *
 * @method StockWeapon|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockWeapon|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockWeapon[]    findAll()
 * @method StockWeapon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockWeaponRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockWeapon::class);
    }

//    /**
//     * @return StockWeapon[] Returns an array of StockWeapon objects
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

    public function findWeaponsOfUser(int $id): array
    {
        $em = $this->getEntityManager();
        $sub = $em->createQueryBuilder();

        $sub->select('p')
            ->from('App\Entity\Weapon', 'p')
            ->InnerJoin('p.stockWeapons', 'sp')
            ->InnerJoin('sp.stockUser', 'u')
            ->andWhere('u.id = :id')
            ->setParameter('id', $id);

        $query = $sub->getQuery();
        return $query->getResult();
    }

//    public function findOneBySomeField($value): ?StockWeapon
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
