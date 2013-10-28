<?php

namespace Jobeet\Finder\Port\Adapter\Persistence\Doctrine;

use Doctrine\ORM\EntityRepository;
use Jobeet\Finder\Domain\Model\Job\Job;
use Jobeet\Finder\Domain\Model\Job\JobRepository;
use DateTime;

class DoctrineJobRepository extends EntityRepository
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

    public function activeJobs()
    {
        $since = (new DateTime())->modify('-30 day');

        return
            $this
                ->createQueryBuilder('j')
                ->where('j.created_at >= :date')
                ->setParameters([
                    'date' => $since
                ])
                ->getQuery()
            ->getResult()
        ;
    }
}