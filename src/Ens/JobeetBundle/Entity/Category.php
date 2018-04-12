<?php

namespace Ens\JobeetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ens\JobeetBundle\Utils\Jobeet;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="Ens\JobeetBundle\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;


    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;


    /**
     * @ORM\OneToMany(targetEntity="Job", mappedBy="category")
     */
    private $jobs;


    /**
     * @ORM\OneToMany(targetEntity="CategoryAffiliate", mappedBy="category")
     */
    private $categoryAffiliates;


    /**
     * @var
     */
    private $active_jobs;

    /**
     * @var
     */
    private $more_jobs;


    /**
     * @param $jobs
     */
    public function setActiveJobs($jobs)
    {
        $this->active_jobs = $jobs;
    }

    /**
     * @return mixed
     */
    public function getActiveJobs()
    {
        return $this->active_jobs;
    }

    /**
     * @param $jobs
     */
    public function setMoreJobs($jobs)
    {
        $this->more_jobs = $jobs >=  0 ? $jobs : 0;
    }

    /**
     * @return mixed
     */
    public function getMoreJobs()
    {
        return $this->more_jobs;
    }

    /**
     *
     * @ORM\PrePersist
     */
    public function setSlugValue()
    {
        $this->slug = Jobeet::slugify($this->getName());
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get idis->ge
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
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
     * @return mixed
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * @param mixed $jobs
     */
    public function setJobs($jobs)
    {
        $this->jobs = $jobs;
    }

    /**
     * @return mixed
     */
    public function getCategoryAffiliates()
    {
        return $this->categoryAffiliates;
    }

    /**
     * @param mixed $categoryAffiliates
     */
    public function setCategoryAffiliates($categoryAffiliates)
    {
        $this->categoryAffiliates = $categoryAffiliates;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return strval( $this->getName() );
    }

}

