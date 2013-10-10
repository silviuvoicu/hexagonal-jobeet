<?php

namespace Jobeet\Finder\Domain\Model\Job;

interface JobRepository
{
    /**
     * Persist a Job to an specialized persistence engine
     *
     * @param Job $job
     *
     * @return void
     */
    public function persist($job);
}