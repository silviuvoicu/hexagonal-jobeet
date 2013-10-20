<?php

namespace Jobeet\Common\Port\Adapter\Doctrine;

use Doctrine\DBAL\Connection;

class DoctrineSession
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * Class constructor
     *
     * @param Connection $connection
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * Starts a new transaction
     */
    public function beginTransaction()
    {
        $this->connection->beginTransaction();
    }

    /**
     * Commits a transaction
     */
    public function commit()
    {
        $this->connection->commit();
    }

    /**
     * Rollbacks a transaction
     */
    public function rollback()
    {
        $this->connection->rollBack();
    }
}