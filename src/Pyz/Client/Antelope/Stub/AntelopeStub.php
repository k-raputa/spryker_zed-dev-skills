<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Antelope\Stub;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class AntelopeStub
{
    public function __construct(
        protected ZedRequestClientInterface $zedRequestClient,
    ) {
    }

    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer,
    ): AntelopeResponseTransfer {
        /**
         * @var \Generated\Shared\Transfer\AntelopeResponseTransfer $antelopeTransfer
         */
        $antelopeTransfer = $this->zedRequestClient->call(
            '/antelope/gateway/get-antelope',
            $antelopeCriteriaTransfer,
        );

        return $antelopeTransfer;
    }
}
