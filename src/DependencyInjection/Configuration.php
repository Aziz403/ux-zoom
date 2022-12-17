<?php

namespace Aziz403\UX\Zoom\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('ux_zoom');

        $treeBuilder
            ->getRootNode()->children()
                ->arrayNode('sdk')->isRequired()->children()
                    ->scalarNode('key')->isRequired()->end()
                    ->scalarNode('secret')->isRequired()->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}