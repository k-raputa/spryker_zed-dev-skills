<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopesBackendApi\Processor\Mapper;

use Generated\Shared\Transfer\AntelopesBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeMapperInterface
{
    public function mapAntelopesBackendApiAttributesToAntelopeTransfer(
        AntelopesBackendApiAttributesTransfer $antelopesBackendApiAttributesTransfer,
        AntelopeTransfer $antelopeTransfer,
    ): AntelopeTransfer;
}
