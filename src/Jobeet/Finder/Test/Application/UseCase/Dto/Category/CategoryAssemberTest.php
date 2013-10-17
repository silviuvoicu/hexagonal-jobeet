<?php

namespace Jobeet\Finder\Test\Application\UseCase\Dto;

use Jobeet\Finder\Application\UseCase\Dto\Category\Category as CategoryDto;
use Jobeet\Finder\Application\UseCase\Dto\Category\CategoryAssembler;
use Mockery;
use PHPUnit_Framework_TestCase;

class CategoryAssemberTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_assemble_a_new_job_entity_from_a_job_dto()
    {
        $categoryDto = new CategoryDto();
        $categoryDto
            ->setName('test')
        ;

        $categoryRepository = Mockery::mock('\Jobeet\Finder\Domain\Model\Category\CategoryRepository');

        $assembler = new CategoryAssembler($categoryRepository);
        $category = $assembler->assemble($categoryDto);

        $this->assertInstanceOf('\Jobeet\Finder\Domain\Model\Category\Category', $category);
        $this->assertAttributeEquals('test', 'name', $category);
    }
}