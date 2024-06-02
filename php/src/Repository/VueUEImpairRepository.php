<?php

namespace App\Repository;

use App\Entity\VueUEImpair;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VueUEImpair|null find($id, $lockMode = null, $lockVersion = null)
 * @method VueUEImpair|null findOneBy(array $criteria, array $orderBy = null)
 * @method VueUEImpair[]    findAll()
 * @method VueUEImpair[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VueUEImpairRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VueUEImpair::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(VueUEImpair $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(VueUEImpair $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return VueUEImpair[] Returns an array of VueUEImpair objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VueUEImpair
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
