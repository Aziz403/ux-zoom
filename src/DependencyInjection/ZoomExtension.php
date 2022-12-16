<?php

namespace Aziz403\UX\Zoom\DependencyInjection;

use Aziz403\UX\Zoom\Service\ZoomMtgBuilder;
use Aziz403\UX\Zoom\Service\ZoomMtgBuilderInterface;
use Aziz403\UX\Zoom\Twig\ZoomTwigExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class ZoomExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        //zoom meeting builder
        $container
            ->setDefinition('zoom.builder', new Definition(ZoomMtgBuilder::class))
            //->addArgument() //TODO: SDK Key & Secret from ENV
            //->addArgument()
            ->setPublic(false);
        $container
            ->setAlias(ZoomMtgBuilderInterface::class, 'zoom.builder')
            ->setPublic(false);

        //twig extension
        $container
            ->setDefinition('zoom.twig_extension', new Definition(ZoomTwigExtension::class))
            ->addArgument(new Reference('webpack_encore.twig_stimulus_extension'))
            ->addTag('twig.extension')
            ->setPublic(false);
    }
}