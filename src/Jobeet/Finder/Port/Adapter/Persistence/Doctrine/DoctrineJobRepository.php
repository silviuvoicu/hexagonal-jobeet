<?php

namespace Jobeet\Finder\Port\Adapter\Persistence\Doctrine;

use Doctrine\ORM\EntityRepository;
use Jobeet\Finder\Domain\Model\Job\Job;
use Jobeet\Finder\Domain\Model\Job\JobRepository;

class DoctrineJobRepository extends EntityRepository implements JobRepository
{
    /**
     * Persist a Job to an specialized persistence engine
     *
     * @param Job $job
     *
     * @return void
     */
    public function persist($job)
    {
        $this->getEntityManager()->persist($job);
        $this->getEntityManager()->flush();
    }
}