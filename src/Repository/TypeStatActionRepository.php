<?php

namespace App\Repository;

use App\Entity\TypeStatAction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeStatAction>
 *
 * @method TypeStatAction|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeStatAction|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeStatAction[]    findAll()
 * @method TypeStatAction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeStatActionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeStatAction::class);
    }

//    /**
//     * @return TypeStatAction[] Returns an array of TypeStatAction objects
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

//    public function findOneBySomeField($value): ?TypeStatAction
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
