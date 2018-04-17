<?php

namespace Ens\JobeetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Affiliate
 *
 * @ORM\Table(name="affiliate")
 * @ORM\Entity(repositoryClass="Ens\JobeetBundle\Repository\AffiliateRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 */
class Affiliate
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
     * @ORM\Column(name="url", type="string", length=255,nullable=true)
     * @Assert\Url
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\Email()
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="affiliates")
     * @ORM\JoinTable(name="category_affiliate",
     * joinColumns={@ORM\JoinColumn(name="affiliate_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")} )
     */
    private $categories;

    /** * Constructor */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     *
     */
    private $isActive;


    /**
     * @return boolean
     */
    public function isIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Affiliate
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Affiliate
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Affiliate
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Affiliate
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }


    /**
     * Add category
     *
     * @param \Ens\JobeetBundle\Entity\Category $category
     * @return Affiliate
     */
    public function addCategory(\Ens\JobeetBundle\Entity\Category $category)
    {
        $this->categories[] = $category; return $this;
    }
    /**
     * Remove category
     *
     *  @param \Ens\JobeetBundle\Entity\Category $category
     */
    public function removeCategory($category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * @ORM\PrePersist
     */
    public function setTokenValue()
    {
        if(!$this->getToken())
        {
            $this->token = sha1($this->getEmail().rand(11111, 99999));
        }
    }

}

