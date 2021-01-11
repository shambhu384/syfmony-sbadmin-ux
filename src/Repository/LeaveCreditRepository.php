<?php

namespace App\Repository;

use App\Entity\LeaveCredit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LeaveCredit|null find($id, $lockMode = null, $lockVersion = null)
 * @method LeaveCredit|null findOneBy(array $criteria, array $orderBy = null)
 * @method LeaveCredit[]    findAll()
 * @method LeaveCredit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeaveCreditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LeaveCredit::class);
    }

    // /**
    //  * @return LeaveCredit[] Returns an array of LeaveCredit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LeaveCredit
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
