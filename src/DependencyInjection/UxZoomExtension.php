<?php

namespace Aziz403\UX\Zoom\DependencyInjection;

use Aziz403\UX\Zoom\Service\ZoomMtgBuilder;
use Aziz403\UX\Zoom\Service\ZoomMtgBuilderInterface;
use Aziz403\UX\Zoom\Twig\ZoomTwigExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\WebpackEncoreBundle\Twig\StimulusTwigExtension;
use Twig\Environment;

class UxZoomExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        //load configuration
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        //zoom meeting builder
        $container
            ->setDefinition('ux_zoom.builder', new Definition(ZoomMtgBuilder::class))
            ->addArgument($config['sdk']['key'])
            ->addArgument($config['sdk']['secret'])
            ->setPublic(false);
        $container
            ->setAlias(ZoomMtgBuilderInterface::class, 'ux_zoom.builder')
            ->setPublic(false);

        //twig extension
        if (class_exists(Environment::class) && class_exists(StimulusTwigExtension::class)) {
            $container
                ->setDefinition('ux_zoom.twig_extension', new Definition(ZoomTwigExtension::class))
                ->addArgument(new Reference('webpack_encore.twig_stimulus_extension'))
                ->addTag('twig.extension')
                ->setPublic(false);
        }
    }
}
