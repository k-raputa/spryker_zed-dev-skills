<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopesBackendApi\Processor\Reader;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeReaderInterface
{
    public function getAntelopeCollection(
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer;

    public function getAntelope(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer;
}
