<?php declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Mapper;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;


class AntelopeLocationMapper implements AntelopeLocationMapperInterface
{
    public function mapAntelopeLocationsBackendApiAttributesToAntelopeLocationTransfer(
        AntelopeLocationsBackendApiAttributesTransfer $antelopeLocationsBackendApiAttributesTransfer,
        AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationTransfer {
        return $antelopeLocationTransfer->fromArray($antelopeLocationsBackendApiAttributesTransfer->toArray(),
            true);
    }
}
