<?php

namespace Jobeet\Bundle\DoctrineBundle\Tests\EventListener;

use Jobeet\Bundle\DoctrineBundle\EventListener\EntityManagerFlusher;
use Mockery;
use PHPUnit_Framework_TestCase;

class EntityManagerFlusherTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EntityManagerFlusher
     */
    private $flusher;

    protected function setUp()
    {
        $this->flusher = new EntityManagerFlusher();
    }

    protected function tearDown()
    {
        $this->flusher = null;
    }

    /**
     * @test
     */
    public function it_should_flush_all_the_entity_managers_registered()
    {
        $em1 = Mockery::mock('\Doctrine\ORM\EntityManager');
        $em1->shouldReceive('flush')->once();

        $em2 = Mockery::mock('\Doctrine\ORM\EntityManager');
        $em2->shouldReceive('flush')->once();

        $this->flusher->registerEntityManagers([$em1, $em2]);

        $this->assertNull($this->flusher->onTerminate());
    }
}