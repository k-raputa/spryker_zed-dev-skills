<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Antelope;

use Pyz\Client\Antelope\Stub\AntelopeStub;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class AntelopeFactory extends AbstractFactory
{
    public function createAntelopeStub(): AntelopeStub
    {
        return new AntelopeStub($this->getZedRequestClient());
    }

    public function getZedRequestClient(): ZedRequestClientInterface
    {
        return $this->getProvidedDependency(AntelopeDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
