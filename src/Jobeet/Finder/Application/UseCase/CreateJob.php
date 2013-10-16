<?php

namespace Jobeet\Finder\Application\UseCase;

use Jobeet\Finder\Application\UseCase\Dto\Job\Job as JobDto;
use Jobeet\Finder\Application\UseCase\Dto\Job\JobAssembler;
use Jobeet\Finder\Domain\Model\Job\Job;
use Jobeet\Finder\Domain\Model\Job\JobRepository;

class CreateJob
{
    /**
     * @var JobRepository
     */
    private $jobRepository;

    /**
     * @var JobAssembler
     */
    private $jobAssembler;

    /**
     * @param JobRepository $jobRepository
     * @param JobAssembler   $jobAssembler
     */
    public function __construct($jobRepository, $jobAssembler)
    {
        $this->jobRepository = $jobRepository;
        $this->jobAssembler = $jobAssembler;
    }

    /**
     * Creates a new Job
     *
     * @param JobDto $jobDto
     *
     * @return void
     */
    public function execute(JobDto $jobDto)
    {
        $job = $this->jobAssembler->assemble($jobDto);

        $this->jobRepository->persist($job);
    }
}