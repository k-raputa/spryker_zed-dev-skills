<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Creator;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Mapper\AntelopeLocationMapperInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeLocationCreator implements AntelopeLocationCreatorInterface
{

    public function __construct(
        protected AntelopeFacadeInterface $antelopeFacade,
        protected AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        protected AntelopeLocationMapperInterface $antelopeLocationMapper
    )
    {
    }

    public function createAntelopeLocation(
        AntelopeLocationsBackendApiAttributesTransfer $antelopesLocationBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer
    {
        $antelopeLocationTransfer = $this->antelopeLocationMapper->mapAntelopeLocationsBackendApiAttributesToAntelopeLocationTransfer(
            $antelopesLocationBackendApiAttributesTransfer,
            new AntelopeLocationTransfer());
        $antelopeLocationTransfer = $this->antelopeFacade->createAntelopeLocation($antelopeLocationTransfer);
        $antelopeLocationCollectionTransfer = (new AntelopeLocationCollectionTransfer())->addAntelopeLocation($antelopeLocationTransfer);

        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse($antelopeLocationCollectionTransfer);
    }
}
