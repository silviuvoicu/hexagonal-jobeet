<?php

namespace Jobeet\Finder\Application\UseCase;

use Exception;
use Jobeet\Finder\Application\UseCase\Dto\Job\Job;

class CreateJobFacade
{
    private $session;

    /**
     * @var CreateJob
     */
    private $createJobUseCase;

    /**
     * Class constructor
     *
     * @param CreateJob $createJobUseCase
     * @param PersistenceSession $session
     */
    public function __construct($createJobUseCase, $session)
    {
        $this->createJobUseCase = $createJobUseCase;
        $this->session = $session;
    }

    /**
     * @param Job $jobDto
     *
     * @throws \Exception
     */
    public function execute($jobDto)
    {
        $this->session->beginTransaction();

        try {
            $this->createJobUseCase->execute($jobDto);
            $this->session->commit();
        } catch(Exception $e) {
            $this->session->rollback();
            throw $e;
        }
    }
}