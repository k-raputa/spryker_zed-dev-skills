<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationGui;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class AntelopeLocationGuiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const string URL_ANTELOPE_LOCATION_LIST = '/antelope-location-gui/index';

    /**
     * @var string
     */
    public const string URL_ANTELOPE_LOCATION_CREATE = '/antelope-location-gui/index/create';
}
