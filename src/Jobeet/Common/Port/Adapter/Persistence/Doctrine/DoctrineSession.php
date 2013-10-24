<?php

namespace Jobeet\Common\Port\Adapter\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;

class DoctrineSession
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Class constructor
     *
     * @param EntityManager $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Starts a new transaction
     */
    public function beginTransaction()
    {
        $this->entityManager->getConnection()->beginTransaction();
    }

    /**
     * Commits a transaction
     */
    public function commit()
    {
        $this->entityManager->getConnection()->commit();
    }

    /**
     * Rollbacks a transaction
     */
    public function rollback()
    {
        $this->entityManager->getConnection()->rollBack();
    }
}