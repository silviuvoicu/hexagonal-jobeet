<?php

namespace Jobeet\Finder\Test\Application\UseCase;

use Jobeet\Finder\Application\UseCase\Dto\Job\Job;
use Jobeet\Finder\Application\UseCase\ShowJob;
use Mockery;
use PHPUnit_Framework_TestCase;

class ShowJobTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_return_nothing_if_no_job_is_found_by_its_token()
    {
        $jobRepository = Mockery::mock('JobRepository');
        $jobRepository->shouldReceive('find')->andReturn(null);

        $showJob = new ShowJob($jobRepository);

        $this->assertNull($showJob->execute(1));
    }

    /**
     * @test
     */
    public function it_should_return_a_job_dto_found_by_its_token()
    {
        $expected = new Job();
        
        $jobRepository = Mockery::mock('JobRepository');
        $jobRepository->shouldReceive('find')->andReturn($expected);

        $showJob = new ShowJob($jobRepository);

        $this->assertEquals($expected, $showJob->execute(1));
    }
}