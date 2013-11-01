<?php

namespace Jobeet\Finder\Domain\Model\Category;

use DateTime;
use Jobeet\Common\Domain\Model\AssertionConcern;
use Jobeet\Finder\Domain\Model\Job\Job;

class Category extends AssertionConcern
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Job[]
     */
    private $jobs;

    /**
     * Class constructor
     *
     * @param string $name
     * @param Job[]  $jobs
     */
    public function __construct($name, $jobs = [])
    {
        $this->assertNotEmpty($name, 'The provided name must not be empty');

        $this->name = $name;
        $this->jobs = $jobs;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add jobs
     *
     * @param Job $jobs
     *
     * @return Category
     */
    public function addJob(Job $jobs)
    {
        $this->jobs[] = $jobs;
    
        return $this;
    }

    /**
     * Remove jobs
     *
     * @param Job $jobs
     */
    public function removeJob(Job $jobs)
    {
        $this->jobs->removeElement($jobs);
    }

    /**
     * Get jobs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    public function activeJobs()
    {
        $activeJobs = [];

        foreach ($this->jobs->slice(0, 10) as $job) {
            if (!$job->hasExpired()) {
                $activeJobs[] = $job;
            }
        }

        return $activeJobs;
    }
}