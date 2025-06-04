<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Expander;

use Generated\Shared\Transfer\AntelopeLocationConditionTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;

interface AntelopeLocationExpanderInterface
{
    public function expandWithFilters(
        AntelopeLocationConditionTransfer $antelopeLocationConditionTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): AntelopeLocationConditionTransfer;
}
