<?php

namespace ContainerAvAUriy;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getHashStringBuscaService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Command\HashString_busca' shared autowired service.
     *
     * @return \App\Command\HashString_busca
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 4).'/src/Command/HashString_busca.php';

        $container->privates['App\\Command\\HashString_busca'] = $instance = new \App\Command\HashString_busca(0, ($container->services['doctrine.orm.default_entity_manager'] ?? $container->load('getDoctrine_Orm_DefaultEntityManagerService')));

        $instance->setName('avato:test-busca');

        return $instance;
    }
}
