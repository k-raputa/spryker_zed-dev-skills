<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeGui;

use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AntelopeGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const string FACADE_ANTELOPE = 'FACADE_ANTELOPE';
    public const string PROPEL_QUERY_ANTELOPE = 'PROPEL_QUERY_ANTELOPE';
    public const string PROPEL_QUERY_ANTELOPE_LOCATION = 'PROPEL_QUERY_ANTELOPE_LOCATION';

    public function provideCommunicationLayerDependencies(Container $container
    ): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addAntelopeFacade($container);
        $container = $this->addAntelopeLocationPropelQuery($container);
        return $this->addAntelopePropelQuery($container);
    }

    protected function addAntelopeFacade(Container $container): Container
    {
        $container->set(
            static::FACADE_ANTELOPE,
            function (Container $container) {
                return $container->getLocator()->antelope()->facade();
            }
        );

        return $container;
    }

    protected function addAntelopeLocationPropelQuery(Container $container): Container
    {
        $container->set(
            static::PROPEL_QUERY_ANTELOPE_LOCATION,
            $container->factory(function () {
                return PyzAntelopeLocationQuery::create();
            })
        );

        return $container;
    }

    protected function addAntelopePropelQuery(Container $container): Container
    {
        $container->set(
            static::PROPEL_QUERY_ANTELOPE,
            $container->factory(function () {
                return PyzAntelopeQuery::create();
            })
        );

        return $container;
    }
}
