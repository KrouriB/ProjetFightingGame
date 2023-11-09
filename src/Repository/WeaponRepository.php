<?php

namespace App\Repository;

use App\Entity\Weapon;
use App\Entity\Personnage;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Weapon>
 *
 * @method Weapon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Weapon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Weapon[]    findAll()
 * @method Weapon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeaponRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Weapon::class);
    }

//    /**
//     * @return Weapon[] Returns an array of Weapon objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    /**
    * @return Weapon[] Returns an array of Weapon objects
    */
    public function findFirstWeapons(): array
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.id < 10')
            ->orderBy('w.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Weapon[] Returns an array of Weapon objects
    */
    public function findWeaponsAdapted(Personnage $personnage): array
    {
        $type = $personnage->getType()->getId();
        $category = $personnage->getCategory()->getId();
        $element = $personnage->getElement()->getId();

        return $this->createQueryBuilder('w')
            ->InnerJoin('w.weaponType', 'wt')
            ->InnerJoin('w.weaponCategory', 'wc')
            ->InnerJoin('w.weaponElement', 'we')
            ->InnerJoin('w.skillElement', 'se')
            ->andWhere('we.id = :element OR we.id = 6')
            ->andWhere('se.id = :element OR se.id = 6')
            ->andWhere('wc.id = :category')
            ->andWhere('wt.id = :type')
            ->setParameter('type', $type)
            ->setParameter('category', $category)
            ->setParameter('element', $element)
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Weapon
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
