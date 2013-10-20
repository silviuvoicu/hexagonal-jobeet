<?php

namespace Jobeet\Finder\Test\Application\UseCase;

use Exception;
use Jobeet\Finder\Application\UseCase\CreateJobFacade;
use Jobeet\Finder\Application\UseCase\Dto\Job\Job;
use Mockery;
use PHPUnit_Framework_TestCase;

class CreateJobFacadeTest extends PHPUnit_Framework_TestCase
{
    private $session;
    private $useCase;
    private $facade;

    protected function setUp()
    {
        $this->session = Mockery::mock('Jobeet\Common\Test\Port\Adapter\InMemory\InMemorySession');
        $this->useCase = Mockery::mock('Jobeet\Finder\Application\UseCase\CreateJob');
        $this->facade = new CreateJobFacade($this->useCase, $this->session);
    }

    protected function tearDown()
    {
        $this->session = $this->useCase = $this->facade = null;
    }

    /**
     * @test
     */
    public function it_should_perform_the_create_job_usecase_transactionally()
    {
        $this->session->shouldReceive('beginTransaction')->once();
        $this->session->shouldReceive('commit')->once();

        $this->useCase->shouldReceive('execute')->once();

        $jobDto = new Job();

        $this->assertNull($this->facade->execute($jobDto));
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function it_should_rollback_the_transaction_if_something_goes_wrong()
    {
        $this->session->shouldReceive('beginTransaction')->once();
        $this->session->shouldReceive('rollback')->once();

        $this->useCase->shouldReceive('execute')->once()->andThrow(new Exception());

        $jobDto = new Job();

        $this->facade->execute($jobDto);
    }
}