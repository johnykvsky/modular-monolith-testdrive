<?php

namespace Spisywarka\Infrastructure\Symfony;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class SpisywarkaKernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getProjectDir(): string
    {
        return dirname(__DIR__, 4);
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import($this->getProjectDir().'/src/Spisywarka/Infrastructure/Symfony/config/{packages}/*.yaml');
        $container->import($this->getProjectDir().'/src/Spisywarka/Infrastructure/Symfony/config/{packages}/'.$this->environment.'/*.yaml');

        if (is_file($this->getProjectDir().'/src/Spisywarka/Infrastructure/Symfony/config/spisywarka_services.yaml')) {
            $container->import($this->getProjectDir().'/src/Spisywarka/Infrastructure/Symfony/config/spisywarka_services.yaml');
            $container->import($this->getProjectDir().'/src/Spisywarka/Infrastructure/Symfony/config/{services}_'.$this->environment.'.yaml');
        } else {
            $container->import($this->getProjectDir().'/src/Spisywarka/Infrastructure/Symfony/config/{services}.php');
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import($this->getProjectDir().'/src/Spisywarka/Infrastructure/Symfony/config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import($this->getProjectDir().'/src/Spisywarka/Infrastructure/Symfony/config/{routes}/*.yaml');

        if (is_file($this->getProjectDir().'/src/Spisywarka/Infrastructure/Symfony/config/spisywarka_routes.yaml')) {
            $routes->import($this->getProjectDir().'/src/Spisywarka/Infrastructure/Symfony/config/spisywarka_routes.yaml');
        } else {
            $routes->import($this->getProjectDir().'/src/Spisywarka/Infrastructure/Symfony/config/{routes}.php');
        }
    }
}
