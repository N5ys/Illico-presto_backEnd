<?php

namespace App\Repository;

use App\Entity\AppParameter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AppParameter>
 *
 * @method AppParameter|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppParameter|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppParameter[]    findAll()
 * @method AppParameter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppParameterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AppParameter::class);
    }

//    /**
//     * @return AppParameter[] Returns an array of AppParameter objects
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

//    public function findOneBySomeField($value): ?AppParameter
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
