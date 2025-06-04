<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Updater;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Mapper\AntelopeLocationMapperInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
class AntelopeLocationUpdater implements AntelopeLocationUpdaterInterface
{
    public function __construct(
        protected AntelopeFacadeInterface $antelopeFacade,
        protected AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        protected AntelopeLocationMapperInterface $antelopeLocationMapper
    )
    {
    }

    public function updateAntelopeLocation(
        AntelopeLocationsBackendApiAttributesTransfer $antelopesLocationBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer
    {
        $antelopeLocationTransfer = $this->antelopeLocationMapper->mapAntelopeLocationsBackendApiAttributesToAntelopeLocationTransfer(
            $antelopesLocationBackendApiAttributesTransfer,
            new AntelopeLocationTransfer());
        $antelopeLocationTransfer = $this->antelopeFacade->updateAntelopeLocation($antelopeLocationTransfer);
        $antelopeLocationCollectionTransfer = (new AntelopeLocationCollectionTransfer())->addAntelopeLocation($antelopeLocationTransfer);
        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse($antelopeLocationCollectionTransfer);
    }
}
