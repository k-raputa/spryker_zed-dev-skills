<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Mapper;



use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;

interface AntelopeLocationMapperInterface
{
    public function mapAntelopeLocationsBackendApiAttributesToAntelopeLocationTransfer(
        AntelopeLocationsBackendApiAttributesTransfer $antelopeLocationsBackendApiAttributesTransfer,
        AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationTransfer;
}
