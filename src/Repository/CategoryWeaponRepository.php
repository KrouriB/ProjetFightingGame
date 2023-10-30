<?php

namespace App\Repository;

use App\Entity\CategoryWeapon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategoryWeapon>
 *
 * @method CategoryWeapon|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryWeapon|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryWeapon[]    findAll()
 * @method CategoryWeapon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryWeaponRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryWeapon::class);
    }

//    /**
//     * @return CategoryWeapon[] Returns an array of CategoryWeapon objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CategoryWeapon
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
