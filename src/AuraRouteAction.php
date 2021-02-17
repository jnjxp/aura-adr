<?php

declare(strict_types = 1);

namespace Jnjxp\AuraAdr;

use Aura\Router\Route as AuraRoute;
use Jnjxp\Adr\Action\ActionFactory;
use Jnjxp\Adr\Action\ActionFactoryInterface;
use Jnjxp\Adr\Action\ActionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuraRouteAction implements MiddlewareInterface
{
    protected $actionFactory;

    public function __construct(ActionFactoryInterface $actionFactory = null)
    {
        $this->actionFactory = $actionFactory ?? new ActionFactory();
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $route = $request->getAttribute(AuraRoute::class);

        if ($route && $route instanceof Route) {
            $action = $this->newAction($route);
            $request = $request->withAttribute(ActionInterface::class, $action);
        }

        return $handler->handle($request);
    }

    protected function newAction(Route $route) : ActionInterface
    {
        return $this->actionFactory->newAction(
            $route->input,
            $route->domain,
            $route->responder
        );
    }
}
