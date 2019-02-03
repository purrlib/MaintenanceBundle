<?php

namespace PurrLib\MaintenanceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('purrlib_maintenance');

        $rootNode
            ->children()
                ->scalarNode('template')->defaultValue('@PurrLibMaintenance/maintenance.html.twig')->end()
                ->arrayNode('authorized_ips')->prototype('scalar')->cannotBeEmpty()->end()
            ->end();

        return $treeBuilder;
    }
}