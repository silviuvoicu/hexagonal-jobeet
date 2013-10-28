<?php

namespace Jobeet\Finder\Application\UseCase;

class ListJobs
{
    /**
     * @var JobRepository
     */
    private $jobRepository;

    /**
     * Class constructor
     *
     * @param JobRepository $jobRepository
     */
    public function __construct($jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function execute()
    {
        return $this->jobRepository->findAll();
    }
}