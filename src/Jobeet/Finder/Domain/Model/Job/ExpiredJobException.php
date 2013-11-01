<?php

namespace Jobeet\Finder\Domain\Model\Job;

use Exception;

class ExpiredJobException extends Exception
{
    /**
     * @var Job
     */
    private $job;

    /**
     * Class constructor
     *
     * @param Job $job
     */
    public function __construct($job)
    {
        $this->job = $job;

        parent::__construct(sprintf('The job %d is expired', $job->getId()));
    }
}