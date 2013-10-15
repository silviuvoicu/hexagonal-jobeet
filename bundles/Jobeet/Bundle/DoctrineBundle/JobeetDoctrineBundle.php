<?php

namespace Jobeet\Bundle\DoctrineBundle;

use Jobeet\Bundle\DoctrineBundle\DependencyInjection\Compiler\RegisterEntityManagersOnEntityManagerFlusherPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class JobeetDoctrineBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new RegisterEntityManagersOnEntityManagerFlusherPass());
    }
}
