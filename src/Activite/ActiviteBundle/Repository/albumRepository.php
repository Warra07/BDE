<?php

namespace Activite\ActiviteBundle\Repository;

/**
 * ancienneRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class albumRepository extends \Doctrine\ORM\EntityRepository
{

    public function byAncienne($ancienne)
    {
         $qb = $this->createQueryBuilder('u')
                    ->select('u')
                    ->where('u.ancienne = :ancienne')
                    ->setParameter('ancienne', $ancienne);
        return $qb->getQuery()->getResult();
    }

}