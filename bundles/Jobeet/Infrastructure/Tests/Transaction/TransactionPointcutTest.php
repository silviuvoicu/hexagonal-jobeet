<?php

namespace Jobeet\Infrastructure\Tests\Transaction;

use Doctrine\Common\Annotations\AnnotationReader;
use Jobeet\Infrastructure\Transaction\TransactionPointcut;
use Mockery;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionObject;
use Jobeet\Infrastructure\Annotation\Transactional;

class TransactionPointcutTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var TransactionPointcut
     */
    private $pointcut;

    private $annotationReader;

    protected function setUp()
    {
        $this->annotationReader = new AnnotationReader();
        $this->pointcut = new TransactionPointcut($this->annotationReader);
    }

    protected function tearDown()
    {
        $this->annotationReader = $this->pointcut = null;
    }

    /**
     * @test
     */
    public function it_should_match_any_class()
    {
        $this->assertTrue($this->pointcut->matchesClass(new ReflectionClass(__CLASS__)));
    }

    /**
     * @test
     */
    public function it_should_match_only_those_methods_with_the_transactional_annotation()
    {
        $reflectionObject = new ReflectionObject($this);

        $this->assertFalse($this->pointcut->matchesMethod($reflectionObject->getMethod('methodWithoutTransactionalAnnotation')));
        $this->assertTrue($this->pointcut->matchesMethod($reflectionObject->getMethod('methodWithTransactionalAnnotation')));
    }

    /**
     * @Transactional
     */
    public function methodWithTransactionalAnnotation()
    {
        // Do nothing
    }

    public function methodWithoutTransactionalAnnotation()
    {
        // Do nothing
    }
}