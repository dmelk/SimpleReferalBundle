<?php

namespace Melk\SimpleReferalBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class MelkSimpleReferalExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $this->mapParameters($config, $container);
    }

    /**
     * Map params for the bunlde
     *
     * @param array $config
     * @param ContainerBuilder $container
     */
    private function mapParameters(array $config, ContainerBuilder $container)
    {
        $container->setParameter('melk_simple_referal.code.class', $config['code_class']);
        $container->setParameter('melk_simple_referal.info.class', $config['info_class']);
    }
}
