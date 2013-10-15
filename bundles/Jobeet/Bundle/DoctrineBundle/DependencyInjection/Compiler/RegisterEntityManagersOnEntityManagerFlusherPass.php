<?php

namespace Jobeet\Bundle\DoctrineBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RegisterEntityManagersOnEntityManagerFlusherPass implements CompilerPassInterface
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
        if (!$container->hasParameter('doctrine.entity_managers') || count($container->getParameter('doctrine.entity_managers')) <= 0) {
            $container->removeDefinition('jobeet_doctrine.event_listener.entity_manager_flusher');
            return;
        }

        $arguments = array_map(
            function($serviceName) {
                return new Reference($serviceName);
            },
            $container->getParameter('doctrine.entity_managers')
        );

        $container
            ->findDefinition('jobeet_doctrine.event_listener.entity_manager_flusher')
            ->addMethodCall('registerEntityManagers', [$arguments])
        ;
    }
}