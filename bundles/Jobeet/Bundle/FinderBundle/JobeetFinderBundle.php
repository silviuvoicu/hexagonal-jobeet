<?php

namespace Jobeet\Bundle\FinderBundle;

use Jobeet\Bundle\FinderBundle\DependencyInjection\Compiler\CreatePersistenceSessionsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class JobeetFinderBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new CreatePersistenceSessionsPass());
    }
}
