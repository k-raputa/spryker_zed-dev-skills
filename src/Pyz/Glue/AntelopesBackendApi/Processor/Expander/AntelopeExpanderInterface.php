<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopesBackendApi\Processor\Expander;

use Generated\Shared\Transfer\AntelopeConditionTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;

interface AntelopeExpanderInterface
{
    public function expandWithFilters(
        AntelopeConditionTransfer $antelopeConditionTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): AntelopeConditionTransfer;
}
