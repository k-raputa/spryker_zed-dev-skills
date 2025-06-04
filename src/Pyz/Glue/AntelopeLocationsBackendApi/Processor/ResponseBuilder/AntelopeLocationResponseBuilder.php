<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiConfig;

class AntelopeLocationResponseBuilder implements AntelopeLocationResponseBuilderInterface
{
    public function createAntelopeLocationResponse(
        AntelopeLocationCollectionTransfer $antelopeLocationCollectionTransfer,
    ): GlueResponseTransfer {
        $responseTransfer = new GlueResponseTransfer();
        foreach ($antelopeLocationCollectionTransfer->getAntelopeLocations() as $antelopeLocation) {
            $resource = $this->mapAntelopeLocationDtoToGlueResourceTransfer($antelopeLocation);
            $responseTransfer->addResource($resource);
        }
        $responseTransfer->setPagination($antelopeLocationCollectionTransfer->getPagination());

        return $responseTransfer;
    }

    protected function mapAntelopeLocationDtoToGlueResourceTransfer(AntelopeLocationTransfer $antelopeLocationTransfer): GlueResourceTransfer
    {
        $resource = new GlueResourceTransfer();
        $resource->setType(AntelopeLocationsBackendApiConfig::RESOURCE_ANTELOPE_LOCATIONS);
        $resource->setId('' . $antelopeLocationTransfer->getIdAntelopeLocation());
        $attributes = new AntelopeLocationsBackendApiAttributesTransfer();
        $attributes->fromArray($antelopeLocationTransfer->toArray(), true);
        $resource->setAttributes($attributes);

        return $resource;
    }
}
