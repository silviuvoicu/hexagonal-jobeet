<?php

namespace Jobeet\Finder\Test\Application\UseCase;

use Jobeet\Finder\Application\UseCase\Dto\Job\Job;
use Jobeet\Finder\Application\UseCase\ListJobs;
use Jobeet\Finder\Domain\Model\Category\Category;
use Mockery;
use PHPUnit_Framework_TestCase;

class ListJobsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_return_no_jobs_when_there_are_no_jobs()
    {
        $categoryRepository = Mockery::mock('CategoryRepository');
        $categoryRepository->shouldReceive('findAll')->andReturn([]);

        $listJobs = new ListJobs($categoryRepository);

        $this->assertEmpty($listJobs->execute());
    }

    /**
     * @test
     */
    public function it_should_return_a_list_of_jobs()
    {
        $categoryList = [
            new Category('test', []),
            new Category('test2', [])
        ];

        $categoryRepository = Mockery::mock('CategoryRepository');
        $categoryRepository->shouldReceive('findAll')->andReturn($categoryList);

        $listJobs = new ListJobs($categoryRepository);

        $this->assertEquals($categoryList, $listJobs->execute());
    }
}