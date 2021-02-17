<?php

declare(strict_types=1);

namespace Jnjxp\AuraAdr;

use Jnjxp\Adr\Action\ActionFactoryInterface;
use Jnjxp\AuraAdr\Route;
use Jnjxp\Router\RouterConfig;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\MiddlewareInterface;

class AuraAdrFactory
{
    public function __invoke(ContainerInterface $container, string $name)
    {
        switch ($name) {
            case RouterConfig::ROUTE_FACTORY:
                return [$this, 'newRoute'];
                break;
            case AuraRouteAction::class:
                return $this->newAuraRouteAction($container);
                break;
            default:
                throw new ServiceNotFoundException($name);
                break;
        }
    }

    public function newRoute() : Route
    {
        return new Route();
    }

    public function newAuraRouteAction(ContainerInterface $container) : MiddlewareInterface
    {
        return new AuraRouteAction($container->get(ActionFactoryInterface::class));
    }
}
