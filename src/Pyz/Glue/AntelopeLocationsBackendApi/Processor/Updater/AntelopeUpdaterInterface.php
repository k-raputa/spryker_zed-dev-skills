<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Updater;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeUpdaterInterface
{
    public function updateAntelopeLocation(
        AntelopeLocationsBackendApiAttributesTransfer $antelopeLocationsBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer;
}
