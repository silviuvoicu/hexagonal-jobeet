<?php

namespace Jobeet\Infrastructure\Transaction;

use Doctrine\Common\Annotations\AnnotationReader;
use JMS\AopBundle\Aop\PointcutInterface;
use ReflectionClass;
use ReflectionMethod;

class TransactionPointcut implements PointcutInterface
{
    /**
     * @var AnnotationReader
     */
    private $annotationReader;

    /**
     * @param AnnotationReader $annotationReader
     */
    function __construct($annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    /**
     * Determines whether the advice applies to instances of the given class.
     *
     * There are some limits as to what you can do in this method. Namely, you may
     * only base your decision on resources that are part of the ContainerBuilder.
     * Specifically, you may not use any data in the class itself, such as
     * annotations.
     *
     * @param ReflectionClass $class
     *
     * @return boolean
     */
    function matchesClass(ReflectionClass $class)
    {
        return true;
    }

    /**
     * Determines whether the advice applies to the given method.
     *
     * This method is not limited in the way the matchesClass method is. It may
     * use information in the associated class to make its decision.
     *
     * @param ReflectionMethod $method
     *
     * @return boolean
     */
    function matchesMethod(ReflectionMethod $method)
    {
        return null !== $this->annotationReader->getMethodAnnotation($method, 'Jobeet\Infrastructure\Annotation\Transactional');
    }
}
