<?php

namespace App\Repository;

use App\Entity\TypeWeapon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeWeapon>
 *
 * @method TypeWeapon|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeWeapon|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeWeapon[]    findAll()
 * @method TypeWeapon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeWeaponRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeWeapon::class);
    }

//    /**
//     * @return TypeWeapon[] Returns an array of TypeWeapon objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeWeapon
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
