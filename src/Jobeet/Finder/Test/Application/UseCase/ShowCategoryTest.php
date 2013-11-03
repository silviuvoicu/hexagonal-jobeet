<?php

namespace Jobeet\Finder\Test\Application\UseCase;

use Jobeet\Finder\Application\UseCase\Dto\Category\Category;
use Jobeet\Finder\Application\UseCase\ShowCategory;
use Mockery;
use PHPUnit_Framework_TestCase;

class ShowCategoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_return_nothing_if_the_category_does_not_exist()
    {
        $name = 'not-existing-category';

        $categoryRepository = Mockery::mock('CategoryRepository');
        $categoryRepository->shouldReceive('findOneByName')->andReturn(null);

        $showCategory = new ShowCategory($categoryRepository);

        $this->assertNull($showCategory->execute($name));
    }

    /**
     * @test
     */
    public function it_should_return_a_category_dto_object()
    {
        $name = 'test';

        $category = new Category();
        $category->setName($name);

        $categoryRepository = Mockery::mock('CategoryRepository');
        $categoryRepository->shouldReceive('findOneByName')->andReturn($category);

        $showCategory = new ShowCategory($categoryRepository);

        $this->assertEquals($category, $showCategory->execute($name));
    }
}