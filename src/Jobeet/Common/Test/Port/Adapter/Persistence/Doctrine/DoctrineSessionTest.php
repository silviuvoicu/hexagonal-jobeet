<?php

namespace Jobeet\Common\Test\Port\Adapter\Persistence\Doctrine;

use Jobeet\Common\Port\Adapter\Persistence\Doctrine\DoctrineSession;
use Mockery;
use Mockery\MockInterface;
use PHPUnit_Framework_TestCase;

class DoctrineSessionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var MockInterface
     */
    private $connection;

    /**
     * @var DoctrineSession
     */
    private $session;

    /**
     * @var MockInterface
     */
    private $entityManager;

    protected function setUp()
    {
        $this->connection = Mockery::mock('Doctrine\DBAL\Connection');
        $this->entityManager = Mockery::mock('Doctrine\ORM\EntityManager');
        $this->entityManager->shouldReceive('getConnection')->andReturn($this->connection);

        $this->session = new DoctrineSession($this->entityManager);
    }

    protected function tearDown()
    {
        $this->connection = $this->session = null;
    }

    /**
     * @test
     */
    public function it_should_start_transactions()
    {
        $this->connection->shouldReceive('beginTransaction')->once();

        $this->assertNull($this->session->beginTransaction());
    }

    /**
     * @test
     */
    public function it_should_commit_transactions()
    {
        $this->connection->shouldReceive('commit')->once();

        $this->assertNull($this->session->commit());
    }

    /**
     * @test
     */
    public function it_should_rollback_transactions()
    {
        $this->connection->shouldReceive('rollBack')->once();

        $this->assertNull($this->session->rollback());
    }
}