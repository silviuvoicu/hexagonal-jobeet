<?php

namespace Jobeet\Bundle\FinderBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class CreatePersistenceSessionsPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasParameter('doctrine.entity_managers')) {
            foreach ($container->getParameter('doctrine.entity_managers') as $name => $serviceName) {
                $doctrineSessionDefinition = new Definition(
                    'Jobeet\Common\Port\Adapter\Persistence\Doctrine\DoctrineSession',
                    [$container->findDefinition($serviceName)]
                );

                $container->addDefinitions([
                    sprintf('jobeet.common.port.adapter.persistence.doctrine.session.%s_session', $name) => $doctrineSessionDefinition
                ]);
            }
        }
    }
}