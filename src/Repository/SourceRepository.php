<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Source;

/**
 * @method Source|null find($id, $lockMode = null, $lockVersion = null)
 * @method Source|null findOneBy(array $criteria, array $orderBy = null)
 * @method Source[]    findAll()
 * @method Source[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method void        add(Source $source)
 * @method void        update(Source $source)
 */
final class SourceRepository extends AbstractRepository
{
    public function getEntityClass(): string
    {
        return Source::class;
    }

    public function findLimited(int $pageNr, int $itemsPerPage)
    {
        $qb = $this->createQueryBuilder('s');
        $qb->setMaxResults($itemsPerPage);
        $qb->setFirstResult(($pageNr - 1) * $itemsPerPage);
        $qb->addOrderBy('s.id', 'ASC');

        return $qb->getQuery()->getResult();
    }
}
