<?php

namespace Jobeet\Infrastructure\Transaction;

use CG\Proxy\MethodInterceptorInterface;
use CG\Proxy\MethodInvocation;
use Doctrine\ORM\EntityManager;
use Exception;

class TransactionInterceptor implements MethodInterceptorInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * Class constructor
     *
     * @param EntityManager $em
     */
    public function __construct($em)
    {
        $this->em = $em;
    }

    /**
     * Called when intercepting a method call.
     *
     * @param MethodInvocation $invocation
     *
     * @return mixed the return value for the method invocation
     *
     * @throws Exception may throw any exception
     */
    public function intercept(MethodInvocation $invocation)
    {
        return $this->em->transactional(function($em) use ($invocation) {
            return $invocation->proceed();
        });
    }
}
