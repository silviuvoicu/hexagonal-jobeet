<?php

namespace Jobeet\Finder\Test\Application\UseCase\Dto\Job;

use DateTime;
use Jobeet\Finder\Application\UseCase\Dto\Category\Category as CategoryDto;
use Jobeet\Finder\Application\UseCase\Dto\Job\Job as JobDto;
use Jobeet\Finder\Application\UseCase\Dto\Job\JobAssembler;
use Jobeet\Finder\Domain\Model\Category\Category;
use Mockery;
use PHPUnit_Framework_TestCase;

class JobAssemberTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_assemble_a_new_job_entity_from_a_job_dto()
    {
        $category = new Category('test');

        $categoryAssembler = Mockery::mock('Jobeet\Finder\Application\UseCase\Dto\Category\CategoryAssembler');
        $categoryAssembler->shouldReceive('assemble')->andReturn($category);

        $categoryDto = new CategoryDto();
        $categoryDto
            ->setName('test')
        ;

        $jobDto = new JobDto();
        $jobDto
            ->setType('test')
            ->setUrl('http://example.com')
            ->setToken('test')
            ->setPosition('test')
            ->setLogo('test.gif')
            ->setCompany('test')
            ->setDescription('test')
            ->setEmail('test@gmail.com')
            ->setExpiresAt(new DateTime())
            ->setHowToApply('test')
            ->setIsActivated(true)
            ->setIsPublic(true)
            ->setCategory($categoryDto)
            ->setLocation('test')
        ;

        $jobRepository = Mockery::mock('Jobeet\Finder\Domain\Model\Job\JobRepository');

        $assembler = new JobAssembler($categoryAssembler, $jobRepository);
        $job = $assembler->assemble($jobDto);

        $this->assertInstanceOf('\Jobeet\Finder\Domain\Model\Job\Job', $job);
        $this->assertInstanceOf('\Jobeet\Finder\DOmain\Model\Category\Category', $job->getCategory());
        $this->assertAttributeEquals('test', 'name', $job->getCategory());

        $assertionCallback = function ($pair) use ($job) {
            $this->assertAttributeEquals($pair[1], $pair[0], $job);
        };

        array_map(
            $assertionCallback->bindTo($this),
            [
                ['type', 'test'],
                ['url', 'http://example.com'],
                ['token', 'test'],
                ['position', 'test'],
                ['logo', 'test.gif'],
                ['company', 'test'],
                ['description', 'test'],
                ['email', 'test@gmail.com'],
                ['expires_at', new DateTime()],
                ['how_to_apply', 'test'],
                ['is_activated', true],
                ['is_public', true]
            ]
        );
    }
}