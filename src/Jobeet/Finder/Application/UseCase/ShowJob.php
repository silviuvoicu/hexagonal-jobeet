<?php

namespace Jobeet\Finder\Application\UseCase;

use Jobeet\Finder\Domain\Model\Job\ExpiredJobException;

class ShowJob
{
    private $jobRepository;

    /**
     * @param JobRepository $jobRepository
     */
    public function __construct($jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function execute($id)
    {
        $job = $this->jobRepository->find($id);

        if (null !== $job && $job->hasExpired()) {
            throw new ExpiredJobException($job);
        }

        return $job;
    }
}