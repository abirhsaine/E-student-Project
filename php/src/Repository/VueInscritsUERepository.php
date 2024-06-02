<?php

namespace App\Repository;

use App\Entity\VueInscritsUE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VueInscritsUE|null find($id, $lockMode = null, $lockVersion = null)
 * @method VueInscritsUE|null findOneBy(array $criteria, array $orderBy = null)
 * @method VueInscritsUE[]    findAll()
 * @method VueInscritsUE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VueInscritsUERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VueInscritsUE::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(VueInscritsUE $entity, bool $flush = true): void
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
    public function remove(VueInscritsUE $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return VueInscritsUE[] Returns an array of VueInscritsUE objects
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
    public function findOneBySomeField($value): ?VueInscritsUE
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
