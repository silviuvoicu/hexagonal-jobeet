<?php

namespace Jobeet\Finder\Application\UseCase;

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
        return $this->jobRepository->find($id);
    }
}