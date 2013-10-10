<?php

namespace Jobeet\Common\Test\Domain\Model;

use DomainException;
use Jobeet\Common\Domain\Model\AssertionConcern;
use PHPUnit_Framework_TestCase;

class AssertionConcernTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var AssertionConcern
     */
    private $sut;

    protected function setUp()
    {
        $this->sut = new AssertionConcern();
    }

    /**
     * @test
     * @expectedException DomainException
     * @expectedExceptionMessage The value should not be empty
     */
    public function it_should_assert_a_given_variable_is_not_empty()
    {
        $this->sut->assertNotEmpty('', 'The value should not be empty');
    }

    /**
     * @test
     * @expectedException DomainException
     * @expectedExceptionMessage The value must be some kind of condition that returns true
     */
    public function it_should_assert_true_boolean_results()
    {
        $this->sut->assertTrue(false, 'The value must be some kind of condition that returns true');
    }

    /**
     * @test
     * @dataProvider filtersDataProvider
     */
    public function it_should_assert_against_standard_php_filters($value, $filter, $message)
    {
        $this->setExpectedException('DomainException', $message);
        $this->sut->assertSatisfiesFilters($value, $filter, $message);
    }

    public function filtersDataProvider()
    {
        return [
            ['pepe', FILTER_VALIDATE_EMAIL, 'This is not a valid e-mail address'],
            ['', FILTER_VALIDATE_BOOLEAN, 'This is not a valid boolean value'],
            ['a', FILTER_VALIDATE_FLOAT, 'This is not a valid float value'],
            ['a', FILTER_VALIDATE_INT, 'This is not a valid int value'],
            ['a', FILTER_VALIDATE_IP, 'This is not a valid IP address'],
            ['a', FILTER_VALIDATE_URL, 'This is not a valid URL'],
        ];
    }

    /**
     * @test
     * @expectedException DomainException
     * @expectedExceptionMessage The string does not have the valid required length of 3
     */
    public function it_should_assert_against_string_length()
    {
        $this->sut->assertLengthIsLowerOrEqualThan('pepe', 3, 'The string does not have the valid required length of 3');
    }
}