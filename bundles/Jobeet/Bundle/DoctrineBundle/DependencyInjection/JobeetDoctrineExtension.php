<?php

namespace Jobeet\Bundle\DoctrineBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class JobeetDoctrineExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if ($config['flush_entity_managers_on_terminate']) {
            $this->registerEntityManagerFlusher($container);
        }
    }

    /**
     * Registers an event listener that will perform a flush over
     * all the entity managers registered
     *
     * @param ContainerBuilder $container
     */
    private function registerEntityManagerFlusher($container)
    {
        $entityManagerFlusherDefinition = new Definition('Jobeet\Bundle\DoctrineBundle\EventListener\EntityManagerFlusher');
        $entityManagerFlusherDefinition->addTag(
            'kernel.event_listener',
            [
                'event' => 'kernel.terminate',
                'method' => 'onTerminate'
            ]
        );

        $container->addDefinitions([
            'jobeet_doctrine.event_listener.entity_manager_flusher' => $entityManagerFlusherDefinition
        ]);
    }
}
