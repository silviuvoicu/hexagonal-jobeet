<?php

namespace Jobeet\Finder\Test\Application\UseCase;

use Jobeet\Finder\Application\UseCase\CreateJob;
use Jobeet\Finder\Application\UseCase\Dto\Category\Category;
use Jobeet\Finder\Application\UseCase\Dto\Job\Job;
use Mockery;
use PHPUnit_Framework_TestCase;

class CreateJobTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_create_a_new_job()
    {
        $jobRepository = $this->getMock('\Jobeet\Domain\Model\Job\JobRepository', ['persist']);
        $jobRepository
            ->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf('\Jobeet\Finder\Domain\Model\Job\Job'))
        ;

        $jobAssembler = Mockery::mock('\Jobeet\Finder\Application\UseCase\Dto\Job\JobAssembler');
        $jobAssembler->shouldReceive('assemble')->with(Mockery::type('\Jobeet\Finder\Application\UseCase\Dto\Job\Job'))->andReturn(Mockery::mock('\Jobeet\Finder\Domain\Model\Job\Job'));

        $sut = new CreateJob($jobRepository, $jobAssembler);

        $category = new Category();
        $category->setName('test');

        $dto = new Job();
        $dto->setCategory($category);
        $dto->setCompany('test');
        $dto->setDescription('test');
        $dto->setEmail('test@gmail.com');
        $dto->setExpiresAt(new \DateTime());
        $dto->setHowToApply('test');
        $dto->setIsActivated(true);
        $dto->setIsPublic(true);
        $dto->setLocation('test');
        $dto->setLogo('test');
        $dto->setPosition('test');
        $dto->setToken('test');
        $dto->setType('test');
        $dto->setUrl('http://example.com');

        $this->assertNull($sut->execute($dto));
    }
}