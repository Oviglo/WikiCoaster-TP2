<?php

namespace App\Repository;

use App\Entity\Coaster;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;

/**
 * @extends ServiceEntityRepository<Coaster>
 */
class CoasterRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private readonly Security $security
    )
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

        if (!$this->security->isGranted('ROLE_ADMIN')) {
            $qb->andWhere('c.published = true OR c.author = :author')
                ->setParameter('author', $this->security->getUser())
            ;
        }

        return new Paginator($qb->getQuery());
    }
}
