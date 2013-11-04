<?php

namespace Jobeet\Finder\Test\Application\UseCase;

use DateTime;
use Jobeet\Finder\Application\UseCase\Dto\Job\Job;
use Jobeet\Finder\Application\UseCase\ShowJob;
use Jobeet\Finder\Domain\Model\Category\Category;
use Mockery;
use PHPUnit_Framework_TestCase;
use Jobeet\Finder\Domain\Model\Job\ExpiredJobException;

class ShowJobTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_return_nothing_if_no_job_is_found_by_its_token()
    {
        $jobRepository = Mockery::mock('JobRepository');
        $jobRepository->shouldReceive('findOneByToken')->andReturn(null);

        $showJob = new ShowJob($jobRepository);

        $this->assertNull($showJob->execute(1));
    }

    /**
     * @test
     */
    public function it_should_return_a_job_dto_found_by_its_id()
    {
        $expected = new \Jobeet\Finder\Domain\Model\Job\Job(
            new Category('test', []),
            'test',
            'test',
            'test@gmail.com', 'test',
            'test',
            'test',
            'test',
            'test',
            (new DateTime())->modify('+1 day')
        );

        $jobRepository = Mockery::mock('JobRepository');
        $jobRepository->shouldReceive('findOneByToken')->andReturn($expected);

        $showJob = new ShowJob($jobRepository);

        $this->assertEquals($expected, $showJob->execute(1));
    }

    /**
     * @test
     * @expectedException \Jobeet\Finder\Domain\Model\Job\ExpiredJobException
     */
    public function it_should_throw_an_exception_if_the_job_has_expired()
    {
        $expiredJob = new \Jobeet\Finder\Domain\Model\Job\Job(
            new Category('test', []),
            'test',
            'test',
            'test@gmail.com', 'test',
            'test',
            'test',
            'test',
            'test',
            (new DateTime())->modify('-1 day')
        );

        $jobRepository = Mockery::mock('JobRepository');
        $jobRepository->shouldReceive('findOneByToken')->andReturn($expiredJob);

        $showJob = new ShowJob($jobRepository);

        $showJob->execute(1);
    }
}