<?php

namespace Pyz\Yves\AntelopePage\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class AntelopePageRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    public const string ROUTE_NAME_ANTELOPE_NAME = '/antelope/_name_';
    public const string ROUTE_NAME_ANTELOPE = '/antelope';

    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    { $routeCollection = $this->addAntelopeAntelopeIndexRoute($routeCollection);
        $routeCollection = $this->addAntelopeAntelopeGetRoute($routeCollection);


        return $routeCollection;
    }

    private function addAntelopeAntelopeGetRoute(
        RouteCollection $routeCollection
    ): RouteCollection {
        $route = $this->buildRoute('/antelope/{name}', 'AntelopePage',
            'Antelope', 'getAction');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(static::ROUTE_NAME_ANTELOPE_NAME,
            $route);

        return $routeCollection;
    }

    private function addAntelopeAntelopeIndexRoute(
        RouteCollection $routeCollection
    ): RouteCollection {
        $route = $this->buildRoute('/antelope', 'AntelopePage',
            'Antelope', 'indexAction');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(static::ROUTE_NAME_ANTELOPE,
            $route);

        return $routeCollection;
    }
}
