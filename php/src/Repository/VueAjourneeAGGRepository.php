<?php

namespace App\Repository;

use App\Entity\VueAjourneeAGG;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VueAjourneeAGG|null find($id, $lockMode = null, $lockVersion = null)
 * @method VueAjourneeAGG|null findOneBy(array $criteria, array $orderBy = null)
 * @method VueAjourneeAGG[]    findAll()
 * @method VueAjourneeAGG[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VueAjourneeAGGRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VueAjourneeAGG::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(VueAjourneeAGG $entity, bool $flush = true): void
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
    public function remove(VueAjourneeAGG $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return VueAjourneeAGG[] Returns an array of VueAjourneeAGG objects
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
    public function findOneBySomeField($value): ?VueAjourneeAGG
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
