<?php

namespace App\Repository;

use App\Entity\JoinTableProfileStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JoinTableProfileStation|null find($id, $lockMode = null, $lockVersion = null)
 * @method JoinTableProfileStation|null findOneBy(array $criteria, array $orderBy = null)
 * @method JoinTableProfileStation[]    findAll()
 * @method JoinTableProfileStation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JoinTableProfileStationRepo extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JoinTableProfileStation::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(JoinTableProfileStation $entity, bool $flush = true): void
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
    public function remove(JoinTableProfileStation $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return JoinTableProfileStation[] Returns an array of JoinTableProfileStation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JoinTableProfileStation
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
