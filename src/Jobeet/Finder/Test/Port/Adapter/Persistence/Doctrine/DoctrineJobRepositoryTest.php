<?php

namespace Jobeet\Finder\Test\Port\Adapter\Persistence\Doctrine;

use Jobeet\Finder\Port\Adapter\Persistence\Doctrine\DoctrineJobRepository;
use Mockery;
use PHPUnit_Framework_TestCase;

class DoctrineJobRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_persist_job_entities()
    {
        $entityManager = Mockery::mock('\Doctrine\ORM\EntityManager');
        $entityManager->shouldReceive('persist')->with(Mockery::type('\Jobeet\Finder\Domain\Model\Job\Job'))->once();
        $entityManager->shouldReceive('flush')->once();

        $classMetadata = Mockery::mock('\Doctrine\ORM\Mapping\ClassMetadata');

        $repository = new DoctrineJobRepository($entityManager, $classMetadata);

        $this->assertNull($repository->persist(Mockery::mock('\Jobeet\Finder\Domain\Model\Job\Job')));
    }
}