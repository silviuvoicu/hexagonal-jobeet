<?php

namespace Jobeet\Finder\Test\Domain\Model\Job;

use DateTime;
use Jobeet\Finder\Domain\Model\Category\Category;
use Jobeet\Finder\Domain\Model\Job\Job;
use PHPUnit_Framework_TestCase;

class JobTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_tell_whether_the_job_has_expired()
    {
        $job = new Job(
            new Category('test', []),
            'test',
            'test',
            'test@gmail.com', 'test',
            'test',
            'test',
            'test',
            'test',
            (new DateTime())->modify('-1 day')
        );

        $this->assertTrue($job->hasExpired());
    }
}