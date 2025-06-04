<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Deleter;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Mapper\AntelopeLocationMapperInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeLocationDeleter implements AntelopeLocationDeleterInterface
{
    public function __construct(
        protected AntelopeFacadeInterface $antelopeFacade,
        protected AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        protected AntelopeLocationMapperInterface $antelopeLocationMapper
    )
    {
    }

    public function deleteAntelopeLocation(GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer
    {
        $antelopeLocationTransfer = (new AntelopeLocationTransfer())->setIdAntelopeLocation((int)$glueRequestTransfer->getResource()?->getId());
        $this->antelopeFacade->deleteAntelopeLocation($antelopeLocationTransfer);

        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse(new AntelopeLocationCollectionTransfer());
    }
}
