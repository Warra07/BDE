<?php

namespace Activite\ActiviteBundle\Repository;

/**
 * ancienneRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class inscriptionRepository extends \Doctrine\ORM\EntityRepository
{

	   public function byInscrit($user, $valide)
    {
         $qb = $this->createQueryBuilder('u')
                    ->select('u')
                    ->where('u.user = :user')
                    ->andWhere('u.valide = :valide')
                    ->orderBy('u.id')
                    ->setParameter('user', $user)->setParameter('valide',$valide);
        return $qb->getQuery()->getResult();
    }
}
