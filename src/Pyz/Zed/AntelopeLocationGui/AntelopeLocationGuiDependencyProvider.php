<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationGui;

use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AntelopeLocationGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const string FACADE_ANTELOPE_LOCATION = 'FACADE_ANTELOPE_LOCATION';
    public const string FACADE_ANTELOPE = 'FACADE_ANTELOPE';
    public const string PROPEL_QUERY_ANTELOPE_LOCATION = 'PROPEL_QUERY_ANTELOPE_LOCATION';

    public function provideCommunicationLayerDependencies(Container $container
    ): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addAntelopeLocationFacade($container);
        $container = $this->addAntelopeFacade($container);

        return $this->addAntelopeLocationPropelQuery($container);
    }

    protected function addAntelopeLocationFacade(Container $container): Container
    {
        $container->set(
            static::FACADE_ANTELOPE_LOCATION,
            function (Container $container) {
                return $container->getLocator()->antelopeLocation()->facade();
            }
        );

        return $container;
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
}
