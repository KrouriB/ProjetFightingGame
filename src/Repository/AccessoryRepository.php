<?php

namespace App\Repository;

use App\Entity\Accessory;
use App\Entity\Personnage;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Accessory>
 *
 * @method Accessory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accessory|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accessory[]    findAll()
 * @method Accessory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccessoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Accessory::class);
    }

//    /**
//     * @return Accessory[] Returns an array of Accessory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    /**
     * @return Accessory[] Returns an array of Accessory objects
     */
    public function findFirstAccessory(): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.id < 4')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Accessory[] Returns an array of Accessory objects
     */
    public function findAccessorysAdapted(Personnage $personnage): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.minLife <= :life')
            ->andWhere('a.userCreator IS NULL')
            ->setParameter('life', $personnage->getLife())
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Accessory
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
