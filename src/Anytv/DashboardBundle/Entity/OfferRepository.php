<?php

namespace Anytv\DashboardBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * OfferRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OfferRepository extends EntityRepository
{
    public function findAllOffers($page, $items_per_page, $order_by, $order, $keyword, $status)
    {
        $first_result = ($items_per_page * ($page-1));
                
        $query = $this->createQueryBuilder('o')
          ->where("o.status = :status AND o.name LIKE :keyword")
          ->setParameters(array('keyword'=>"%$keyword%", 'status'=>$status))
          ->setFirstResult($first_result)
          ->setMaxResults($items_per_page)
          ->orderBy('o.'.$order_by, $order)
          ->getQuery();
        
        return $query->getResult();
    }
    
    public function countAllOffers($keyword, $status)
    {    
        $query = $this->createQueryBuilder('o')
          ->select('count(o.id)')
          ->where("o.status = :status AND o.name LIKE :keyword")
          ->setParameters(array('keyword'=>"%$keyword%", 'status'=>$status))
          ->getQuery();
        
        return $query->getSingleScalarResult();
    }
    
    public function findOneByIdJoinedToCategory($id)
   {
      // edit this sample
      $query = $this->getEntityManager()
        ->createQuery('
            SELECT p, c FROM AcmeStoreBundle:Product p
            JOIN p.category c
            WHERE p.id = :id'
        )->setParameter('id', $id);

      try {
        return $query->getSingleResult();
      } catch (\Doctrine\ORM\NoResultException $e) {
        return null;
      }
    }
}
