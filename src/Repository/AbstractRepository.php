<?php
declare(strict_types=1);

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

abstract class AbstractRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, $this->getEntityClass());
    }

    abstract public function getEntityClass(): string;

    /**
     * @param mixed $entity
     * @throws \InvalidArgumentException
     */
    public function validateEntityClass($entity): void
    {
        $entityClass = $this->getEntityClass();

        if (!is_a($entity, $entityClass)) {
            throw new \InvalidArgumentException('Expected: ' . $entityClass);
        }
    }

    /**
     * @param object $entity
     * @throws \InvalidArgumentException
     */
    public function add($entity): void
    {
        $this->validateEntityClass($entity);

        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }

    /**
     * @param $entity
     * @throws \InvalidArgumentException
     */
    public function update($entity): void
    {
        $this->validateEntityClass($entity);

        $em = $this->getEntityManager();
        $em->flush();
    }
}
