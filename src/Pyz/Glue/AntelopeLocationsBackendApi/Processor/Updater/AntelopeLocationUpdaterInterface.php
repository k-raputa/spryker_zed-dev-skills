<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Updater;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;

interface AntelopeLocationUpdaterInterface
{
    public function updateAntelopeLocation(
        AntelopeLocationsBackendApiAttributesTransfer $antelopesLocationBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer
    );
}
