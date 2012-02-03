<?php

namespace Acme\TransportBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Acme\TransportBundle\DependencyInjection\Compiler\TransportCompilerPass;

class AcmeTransportBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TransportCompilerPass());
    }
}