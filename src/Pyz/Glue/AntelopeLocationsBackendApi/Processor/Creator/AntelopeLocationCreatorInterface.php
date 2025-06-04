<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Creator;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeLocationCreatorInterface
{
    public function createAntelopeLocation(
        AntelopeLocationsBackendApiAttributesTransfer $antelopesLocationBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer;
}
