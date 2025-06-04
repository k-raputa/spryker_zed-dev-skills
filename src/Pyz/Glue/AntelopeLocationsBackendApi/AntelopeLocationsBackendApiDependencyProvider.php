<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationsBackendApi;

use Spryker\Glue\Kernel\Backend\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Backend\Container;

class AntelopeLocationsBackendApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const string FACADE_ANTELOPE = 'FACADE_ANTELOPE';

    public function provideBackendDependencies(Container $container): Container
    {
        $container = parent::provideBackendDependencies($container);
        $container = $this->addAntelopeFacade($container);

        return $container;
    }

    protected function addAntelopeFacade(Container $container): Container
    {
        $container->set(static::FACADE_ANTELOPE, function (Container $container) {
            return $container->getLocator()->antelope()->facade();
        });

        return $container;
    }
}
