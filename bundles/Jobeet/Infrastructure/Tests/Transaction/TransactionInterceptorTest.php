<?php

namespace Jobeet\Infratructure\Tests\Transaction;

use CG\Proxy\MethodInvocation;
use Jobeet\Infrastructure\Transaction\TransactionInterceptor;
use Mockery;
use PHPUnit_Framework_TestCase;
use ReflectionObject;

class TransactionInterceptorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_intercept_the_method_invocation_and_wrap_it_inside_a_transaction()
    {
        $em = Mockery::mock('Doctrine\ORM\EntityManager');
        $em
            ->shouldReceive('transactional')
            ->with(Mockery::on(function($callable) {
                return is_callable($callable);
            }))
            ->andReturnUsing(function($callable) {
                return $callable(Mockery::self());
            })
        ;

        $reflectionObject = new ReflectionObject($this);
        $methodInvocation = new MethodInvocation($reflectionObject->getMethod('interceptableMethod'), $this, [], []);

        $transactionInterceptor = new TransactionInterceptor($em);
        $this->assertEquals('test', $transactionInterceptor->intercept($methodInvocation));
    }

    public function interceptableMethod()
    {
        return 'test';
    }
}