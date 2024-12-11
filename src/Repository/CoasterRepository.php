<?php

namespace App\Repository;

use App\Entity\Coaster;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Coaster>
 */
class CoasterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coaster::class);
    }

    public function findFiltered(
        int $parkId = 0,
        int $categoryId = 0,
        string $search = '',
        int $begin = 0,
        int $count = 20
    ): Paginator
    {
        $qb = $this->createQueryBuilder('c')
            ->addSelect('p, cat') // Optimisation du nombre de requêtes
            ->leftJoin('c.park', 'p')
            ->leftJoin('c.categories', 'cat')
            ->setMaxResults($count) // LIMIT
            ->setFirstResult($begin) // OFFSET
        ;

        if ($parkId !== 0) {
            $qb->where('p.id = :parkId')
                ->setParameter(':parkId', $parkId)
            ;
        }

        if ($categoryId !== 0) {
            $qb->andWhere('cat.id = :catId')
                ->setParameter(':catId', $categoryId)
            ;
        }

        if (strlen($search) > 2) {
            $qb->andWhere($qb->expr()->like('c.name', ':search'))
                ->setParameter('search', "%$search%")
            ;

            // $qb->andWhere('c.name LIKE :search')
        }

        return new Paginator($qb->getQuery());
    }
}
