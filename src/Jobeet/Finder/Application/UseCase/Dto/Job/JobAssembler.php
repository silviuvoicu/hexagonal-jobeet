<?php

namespace Jobeet\Finder\Application\UseCase\Dto\Job;

use Jobeet\Finder\Application\UseCase\Dto\Category\CategoryAssembler;
use Jobeet\Finder\Application\UseCase\Dto\Job\Job as JobDto;
use Jobeet\Finder\Domain\Model\Job\Job as JobEntity;

class JobAssembler
{
    /**
     * @var CategoryAssembler
     */
    private $categoryAssembler;

    /**
     * @var
     */
    private $jobRepository;

    /**
     * @param CategoryAssembler $categoryAssembler
     * @param                   $jobRepository
     */
    public function __construct($categoryAssembler, $jobRepository)
    {
        $this->categoryAssembler = $categoryAssembler;
        $this->jobRepository = $jobRepository;
    }

    /**
     * From a given Job DTO assembles a new Job Entity
     *
     * @param JobDto $jobDto
     *
     * @return Job
     */
    public function assemble($jobDto)
    {
        if (null !== $jobDto->getId()) {
            return $this->jobRepository->find($jobDto->getId());
        }

        $job = new JobEntity(
            $this->categoryAssembler->assemble($jobDto->getCategory()),
            $jobDto->getCompany(),
            $jobDto->getDescription(),
            $jobDto->getEmail(),
            $jobDto->getHowToApply(),
            $jobDto->getLocation(),
            $jobDto->getType(),
            $jobDto->getLogo(),
            $jobDto->getUrl(),
            $jobDto->getExpiresAt(),
            $jobDto->getPosition(),
            $jobDto->getIsPublic(),
            $jobDto->getIsActivated(),
            $jobDto->getToken()
        );

        return $job;
    }
}