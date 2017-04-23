<?php

namespace Activite\ActiviteBundle\Repository;

/**
 * envoteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class envoteRepository extends \Doctrine\ORM\EntityRepository
{


	    public function byvota($user, $envote)
    {
         $qb = $this->createQueryBuilder('u')
                    ->select('u')
                    ->where('u.user = :user')
                    ->andWhere('u.envote = :envote')
                    ->orderBy('u.id')
                    ->setParameter('user', $user)->setParameter('envote',$envote);
        return $qb->getQuery()->getResult();
    }
}