<?php

namespace App\Repository;

use App\Entity\VueModuleImpair;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VueModuleImpair|null find($id, $lockMode = null, $lockVersion = null)
 * @method VueModuleImpair|null findOneBy(array $criteria, array $orderBy = null)
 * @method VueModuleImpair[]    findAll()
 * @method VueModuleImpair[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VueModuleImpairRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VueModuleImpair::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(VueModuleImpair $entity, bool $flush = true): void
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
    public function remove(VueModuleImpair $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return VueModuleImpair[] Returns an array of VueModuleImpair objects
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
    public function findOneBySomeField($value): ?VueModuleImpair
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
