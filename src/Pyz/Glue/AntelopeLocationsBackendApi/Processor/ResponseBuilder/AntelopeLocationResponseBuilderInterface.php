<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeLocationResponseBuilderInterface
{
    public function createAntelopeLocationResponse(AntelopeLocationCollectionTransfer $antelopeLocationCollectionTransfer
    ): GlueResponseTransfer;
}
