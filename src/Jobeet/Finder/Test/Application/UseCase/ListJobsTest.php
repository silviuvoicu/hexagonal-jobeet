<?php

namespace Jobeet\Finder\Test\Application\UseCase;

use Jobeet\Finder\Application\UseCase\Dto\Job\Job;
use Jobeet\Finder\Application\UseCase\ListJobs;
use Mockery;
use PHPUnit_Framework_TestCase;

class ListJobsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_return_no_jobs_when_there_are_no_jobs()
    {
        $jobRepository = Mockery::mock('JobRepository');
        $jobRepository->shouldReceive('findAll')->andReturn([]);

        $listJobs = new ListJobs($jobRepository);

        $this->assertEmpty($listJobs->execute());
    }

    /**
     * @test
     */
    public function it_should_return_a_list_of_jobs()
    {
        $jobList = [
            new Job(),
            new Job()
        ];

        $jobRepository = Mockery::mock('JobRepository');
        $jobRepository->shouldReceive('findAll')->andReturn($jobList);

        $listJobs = new ListJobs($jobRepository);

        $this->assertEquals($jobList, $listJobs->execute());
    }
}