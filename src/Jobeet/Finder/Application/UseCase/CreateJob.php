<?php

namespace Jobeet\Finder\Application\UseCase;

use Jobeet\Finder\Application\UseCase\Dto\Job\Job as JobDto;
use Jobeet\Finder\Domain\Model\Job\Job;
use Jobeet\Finder\Domain\Model\Job\JobRepository;

class CreateJob
{
    /**
     * @var JobRepository
     */
    private $jobRepository;

    /**
     * @param JobRepository $jobRepository
     */
    public function __construct($jobRepository)
    {
        $this->jobRepository = $jobRepository;
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
        $job = new Job(
            $jobDto->getCategory(),
            $jobDto->getCompany(),
            $jobDto->getDescription(),
            $jobDto->getEmail(),
            $jobDto->getExpiresAt(),
            $jobDto->getHowToApply(),
            $jobDto->getLocation(),
            $jobDto->getType(),
            $jobDto->getLogo(),
            $jobDto->getUrl(),
            $jobDto->getPosition(),
            $jobDto->getIsPublic(),
            $jobDto->getIsActivated(),
            $jobDto->getToken()
        );

        $this->jobRepository->persist($job);
    }
}