<?php

namespace App\Repository;

use App\Entity\Hunter;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use DateTime;

/**
 * @extends ServiceEntityRepository<Hunter>
 *
 * @method Hunter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hunter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hunter[]    findAll()
 * @method Hunter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HunterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hunter::class);
    }

    public function add(Hunter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Hunter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function findByDate(DateTime $value): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.date >= :val')
            ->setParameter('val', $value)
            ->orderBy('d.date', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    public function findOneBySomeField($value): ?Hunter
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
