<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Usr;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
  
  public function getNb() {

        return $this->createQueryBuilder('l')

                        ->select('COUNT(l)')

                        ->getQuery()

                        ->getSingleScalarResult();

    }
}
