<?php

declare(strict_types=1);

namespace Jnjxp\AuraAdr;

use Interop\Container\ServiceProviderInterface;
use Jnjxp\Router\RouterConfig;

class AuraAdrServiceProvider implements ServiceProviderInterface
{
    public function getFactories()
    {
        return [
            RouterConfig::ROUTE_FACTORY => AuraAdrFactory::class,
            AuraRouteAction::class => AuraAdrFactory::class,
        ];
    }

    public function getExtensions()
    {
        return [];
    }
}
