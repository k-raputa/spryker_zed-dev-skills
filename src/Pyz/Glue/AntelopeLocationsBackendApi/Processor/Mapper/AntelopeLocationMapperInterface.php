<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Mapper;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;

interface AntelopeLocationMapperInterface
{
    public function mapAntelopeLocationsBackendApiAttributesToAntelopeLocationTransfer(
        AntelopeLocationsBackendApiAttributesTransfer $antelopeLocationsBackendApiAttributesTransfer,
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer;
}
