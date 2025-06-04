<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder;

use ArrayObject;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface ErrorResponseBuilderInterface
{
    /**
     * @param \ArrayObject<int, \Generated\Shared\Transfer\ErrorTransfer> $errorTransfers
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function createErrorResponse(ArrayObject $errorTransfers): GlueResponseTransfer;

    /**
     * @param string $errorMessage
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function createErrorResponseFromErrorMessage(
        string $errorMessage,
    ): GlueResponseTransfer;
}
