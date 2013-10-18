<?php

namespace Jobeet\Finder\Test\Port\Adapter\Persistence\Doctrine;

use Jobeet\Finder\Port\Adapter\Persistence\Doctrine\DoctrineCategoryRepository;
use Mockery;
use PHPUnit_Framework_TestCase;

class DoctrineCategoryRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_persist_category_entities()
    {
        $entityManager = Mockery::mock('Doctrine\ORM\EntityManager');
        $entityManager->shouldReceive('persist')->with(Mockery::type('Jobeet\Finder\Domain\Model\Category\Category'))->once();

        $classMetadata = Mockery::mock('Doctrine\ORM\Mapping\ClassMetadata');

        $repository = new DoctrineCategoryRepository($entityManager, $classMetadata);

        $this->assertNull($repository->persist(Mockery::mock('Jobeet\Finder\Domain\Model\Category\Category')));
    }
}