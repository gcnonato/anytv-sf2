<?php

namespace Anytv\DashboardBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ConversionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ConversionRepository extends EntityRepository
{
    public function findAllConversions($page, $items_per_page, $order_by, $order)
    {
        $first_result = ($items_per_page * ($page-1));
        
        $query = $this->createQueryBuilder('c');
         
        $query = $query->setFirstResult($first_result)
                       ->setMaxResults($items_per_page)
                       ->orderBy('c.'.$order_by, $order)
                       ->getQuery();
          
        return $query->getResult();
    }
    
    public function countAllConversions()
    {    
        $query = $this->createQueryBuilder('c')
                      ->select('count(c.id)');
        
        $query = $query->getQuery(); 
          
        return $query->getSingleScalarResult();
    }
    
    public function getMaxConversionId()
    {    
        $query = $this->createQueryBuilder('c')
                      ->select('max(c.conversionId)')
                      ->getQuery();
        
        return $query->getSingleScalarResult();
    }
}
