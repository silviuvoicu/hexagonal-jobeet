<?php

namespace Jobeet\Bundle\FinderBundle\Tests\Form\Transformer;

use Jobeet\Bundle\FinderBundle\Form\Transformer\CategoryToNameTransformer;
use Jobeet\Finder\Domain\Model\Category\Category;
use PHPUnit_Framework_TestCase;

class CategoryToNameTransformerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var CategoryToNameTransformer
     */
    private $transformer;

    protected function setUp()
    {
        $this->transformer = new CategoryToNameTransformer();
    }

    protected function tearDown()
    {
        $this->transformer = null;
    }

    /**
     * @test
     */
    public function it_should_do_nothing_if_the_given_category_is_empty()
    {
        $this->assertNull($this->transformer->transform(null));
    }

    /**
     * @test
     */
    public function it_should_transform_a_given_category_to_its_string_representation()
    {
        $this->assertEquals('test', $this->transformer->transform(new Category('test')));
    }

    /**
     * @test
     */
    public function it_should_reverse_transform_a_given_category_retrieved_from_a_form_to_a_category_dto()
    {
        $this->assertInstanceOf(
            '\Jobeet\Finder\Application\UseCase\Dto\Category\Category',
            $this->transformer->reverseTransform(new \Jobeet\Finder\Application\UseCase\Dto\Category\Category('test'))
        );
    }
}