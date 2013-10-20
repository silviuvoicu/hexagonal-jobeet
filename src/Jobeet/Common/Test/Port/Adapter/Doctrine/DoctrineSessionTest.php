<?php

namespace Jobeet\Common\Test\Port\Adapter\Doctrine;

use Jobeet\Common\Port\Adapter\Doctrine\DoctrineSession;
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

    protected function setUp()
    {
        $this->connection = Mockery::mock('Doctrine\DBAL\Connection');

        $this->session = new DoctrineSession($this->connection);
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