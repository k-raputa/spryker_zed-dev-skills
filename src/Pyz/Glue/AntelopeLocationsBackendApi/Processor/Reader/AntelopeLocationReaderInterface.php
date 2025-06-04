<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Reader;

use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeLocationReaderInterface
{
    public function getAntelopeLocation(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer;

    public function getAntelopeLocationCollectionTransfer(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): GlueResponseTransfer;

    public function getAntelopeLocationCollection(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer;
}
