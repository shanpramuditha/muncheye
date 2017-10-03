<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="vendor", type="string", length=255)
     */
    private $vendor;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255,unique = true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="product", type="string", length=255)
     */
    private $product;

    /**
     * @var string
     *
     * @ORM\Column(name="launchDate", type="string", length=255)
     */
    private $launchDate;

    /**
     * @var string
     *
     * @ORM\Column(name="launchTime", type="string", length=255)
     */
    private $launchTime;

    /**
     * @var string
     *
     * @ORM\Column(name="frontEndPrice", type="string", length=255)
     */
    private $frontEndPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="commision", type="string", length=255)
     */
    private $commision;

    /**
     * @var string
     *
     * @ORM\Column(name="jvPage", type="string", length=255)
     */
    private $jvPage;

    /**
     * @var string
     *
     * @ORM\Column(name="affiliateNetwork", type="string", length=255)
     */
    private $affiliateNetwork;

    /**
     * @var string
     *
     * @ORM\Column(name="niche", type="string", length=255)
     */
    private $niche;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="productUpdatedAt", type="datetime", nullable=true)
     */
    private $productUpdatedAt;


    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text",nullable=true)
     */
    private $comment;


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
     * Set vendor
     *
     * @param string $vendor
     * @return Product
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get vendor
     *
     * @return string 
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Set product
     *
     * @param string $product
     * @return Product
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return string 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set launchDate
     *
     * @param string $launchDate
     * @return Product
     */
    public function setLaunchDate($launchDate)
    {
        $this->launchDate = $launchDate;

        return $this;
    }

    /**
     * Get launchDate
     *
     * @return string 
     */
    public function getLaunchDate()
    {
        return $this->launchDate;
    }

    /**
     * Set launchTime
     *
     * @param string $launchTime
     * @return Product
     */
    public function setLaunchTime($launchTime)
    {
        $this->launchTime = $launchTime;

        return $this;
    }

    /**
     * Get launchTime
     *
     * @return string 
     */
    public function getLaunchTime()
    {
        return $this->launchTime;
    }

    /**
     * Set frontEndPrice
     *
     * @param string $frontEndPrice
     * @return Product
     */
    public function setFrontEndPrice($frontEndPrice)
    {
        $this->frontEndPrice = $frontEndPrice;

        return $this;
    }

    /**
     * Get frontEndPrice
     *
     * @return string 
     */
    public function getFrontEndPrice()
    {
        return $this->frontEndPrice;
    }

    /**
     * Set commision
     *
     * @param string $commision
     * @return Product
     */
    public function setCommision($commision)
    {
        $this->commision = $commision;

        return $this;
    }

    /**
     * Get commision
     *
     * @return string 
     */
    public function getCommision()
    {
        return $this->commision;
    }

    /**
     * Set jvPage
     *
     * @param string $jvPage
     * @return Product
     */
    public function setJvPage($jvPage)
    {
        $this->jvPage = $jvPage;

        return $this;
    }

    /**
     * Get jvPage
     *
     * @return string 
     */
    public function getJvPage()
    {
        return $this->jvPage;
    }

    /**
     * Set affiliateNetwork
     *
     * @param string $affiliateNetwork
     * @return Product
     */
    public function setAffiliateNetwork($affiliateNetwork)
    {
        $this->affiliateNetwork = $affiliateNetwork;

        return $this;
    }

    /**
     * Get affiliateNetwork
     *
     * @return string 
     */
    public function getAffiliateNetwork()
    {
        return $this->affiliateNetwork;
    }

    /**
     * Set niche
     *
     * @param string $niche
     * @return Product
     */
    public function setNiche($niche)
    {
        $this->niche = $niche;

        return $this;
    }

    /**
     * Get niche
     *
     * @return string 
     */
    public function getNiche()
    {
        return $this->niche;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return Product
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime 
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Product
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Product
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Product
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Product
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set productUpdatedAt
     *
     * @param \DateTime $productUpdatedAt
     * @return Product
     */
    public function setProductUpdatedAt($productUpdatedAt)
    {
        $this->productUpdatedAt = $productUpdatedAt;

        return $this;
    }

    /**
     * Get productUpdatedAt
     *
     * @return \DateTime 
     */
    public function getProductUpdatedAt()
    {
        return $this->productUpdatedAt;
    }
}
