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
     * @param CategoryAssembler $categoryAssembler
     */
    public function __construct($categoryAssembler)
    {
        $this->categoryAssembler = $categoryAssembler;
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
        $job = new JobEntity(
            $this->categoryAssembler->assemble($jobDto->getCategory()),
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

        return $job;
    }
}