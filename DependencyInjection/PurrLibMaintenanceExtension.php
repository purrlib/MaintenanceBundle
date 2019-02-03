<?php

namespace PurrLib\MaintenanceBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class PurrLibMaintenanceExtension
 * @package Purrlib\MaintenanceBundle\DependencyInjection
 */
class PurrLibMaintenanceExtension extends Extension
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('purrlib_maintenance', $config);

        foreach ($config as $name => $value) {
            $container->setParameter(sprintf('purrlib_maintenance.%s', $name), $value);
        }
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'purrlib_maintenance';
    }
}