<?php

namespace MealBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class DayRepository
 * @package MealBundle\Repository
 */
class DayRepository extends EntityRepository
{
    public function findAllSortedByDate()
    {
        return $this->createQueryBuilder('d')
            ->select()
            ->orderBy('d.day', 'ASC')
            ->getQuery()->getResult();
    }
}
