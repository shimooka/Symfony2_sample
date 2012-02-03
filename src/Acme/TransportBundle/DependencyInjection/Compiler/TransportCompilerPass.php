<?php

namespace Acme\TransportBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class TransportCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('transport_chain')) {
            return;
        }

        $definition = $container->getDefinition('transport_chain');

        foreach ($container->findTaggedServiceIds('transport') as $id => $attributes) {
            $definition->addMethodCall('addTransport', array(new Reference($id)));
        }
    }
}