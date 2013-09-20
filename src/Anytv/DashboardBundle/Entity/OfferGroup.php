<?php

namespace Anytv\DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * OfferGroup
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Anytv\DashboardBundle\Entity\OfferGroupRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OfferGroup
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="offer_group_id", type="integer")
     */
    private $offerGroupId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="offer_count", type="integer")
     */
    private $offerCount;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updated_at;
    
    /**
     * @ORM\ManyToMany(targetEntity="Offer", mappedBy="offerGroups")
     */
    private $offers;
    
    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return OfferGroup
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return OfferGroup
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set offerCount
     *
     * @param integer $offerCount
     * @return OfferGroup
     */
    public function setOfferCount($offerCount)
    {
        $this->offerCount = $offerCount;
    
        return $this;
    }

    /**
     * Get offerCount
     *
     * @return integer 
     */
    public function getOfferCount()
    {
        return $this->offerCount;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return OfferGroup
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return OfferGroup
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
      $this->created_at = new \DateTime();
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
      if(!$this->updated_at)
      {
        $this->updated_at = new \DateTime();
      }
    }

    /**
     * Set offerGroupId
     *
     * @param integer $offerGroupId
     * @return OfferGroup
     */
    public function setOfferGroupId($offerGroupId)
    {
        $this->offerGroupId = $offerGroupId;
    
        return $this;
    }

    /**
     * Get offerGroupId
     *
     * @return integer 
     */
    public function getOfferGroupId()
    {
        return $this->offerGroupId;
    }
    
    public function __toString() 
    {
      return $this->getName();    
    }

    /**
     * Add offers
     *
     * @param \Anytv\DashboardBundle\Entity\Offer $offers
     * @return OfferGroup
     */
    public function addOffer(\Anytv\DashboardBundle\Entity\Offer $offers)
    {
        $this->offers[] = $offers;
    
        return $this;
    }

    /**
     * Remove offers
     *
     * @param \Anytv\DashboardBundle\Entity\Offer $offers
     */
    public function removeOffer(\Anytv\DashboardBundle\Entity\Offer $offers)
    {
        $this->offers->removeElement($offers);
    }

    /**
     * Get offers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOffers()
    {
        return $this->offers;
    }
}