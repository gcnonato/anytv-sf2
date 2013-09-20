<?php

namespace Anytv\DashboardBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TrafficReferralRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TrafficReferralRepository extends EntityRepository
{
    public function findAllTrafficReferrals($page, $items_per_page, $order_by, $order, $stat_date)
    {
        $first_result = ($items_per_page * ($page-1));
        
        $query = $this->getEntityManager()->createQueryBuilder()
          ->select(array('tr', 'a', 'o'))
          ->from('Anytv\DashboardBundle\Entity\TrafficReferral', 'tr')
          ->leftJoin('tr.affiliate', 'a')
          ->leftJoin('tr.offer', 'o')
          ->where("tr.statDate = :stat_date")
          ->setParameter('stat_date', $stat_date)
          ->setFirstResult($first_result)
          ->setMaxResults($items_per_page)
          ->orderBy('tr.'.$order_by, $order)
          ->getQuery();
        
        return $query->getResult();
    }
    
    public function countAllTrafficReferrals($stat_date)
    {    
        $query = $this->createQueryBuilder('tr')
          ->select('count(tr.id)')
          ->where("tr.statDate = :stat_date")
          ->setParameter('stat_date', $stat_date)
          ->getQuery();
        
        return $query->getSingleScalarResult();
    }
    
    public function findTrafficReferralsByAffiliate($affiliate)
    {
        $query = $this->getEntityManager()->createQueryBuilder()
          ->select(array('tr', 'a', 'o'))
          ->from('Anytv\DashboardBundle\Entity\TrafficReferral', 'tr')
          ->leftJoin('tr.affiliate', 'a')
          ->leftJoin('tr.offer', 'o')
          ->where("tr.affiliate = :affiliate")
          ->setParameter('affiliate', $affiliate)
          ->addGroupBy("tr.url")
          ->orderBy('tr.offer', 'ASC')
          ->getQuery();
        
        return $query->getResult();
    }
}
