<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Reader;

use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationConditionTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Expander\AntelopeLocationExpanderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeLocationReader implements AntelopeLocationReaderInterface
{
    public function __construct(
        protected readonly AntelopeFacadeInterface $antelopeFacade,
        protected readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        protected readonly AntelopeLocationExpanderInterface $antelopeLocationsExpander,
    )
    {
    }

    public function getAntelopeLocation(GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
        $conditions = new AntelopeLocationConditionTransfer();
        $conditions->setIdAntelopeLocation((int)$glueRequestTransfer->getResource()?->getId());
        $antelopeLocationCriteriaTransfer->setAntelopeLocationsConditions($conditions);

        return $this->getAntelopeLocationCollectionTransfer($antelopeLocationCriteriaTransfer);
    }

    public function getAntelopeLocationCollectionTransfer(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): GlueResponseTransfer {
        $antelopeCollectionTransfer = $this->antelopeFacade
            ->getAntelopeLocationCollection($antelopeLocationCriteriaTransfer);

        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse($antelopeCollectionTransfer);
    }

    public function getAntelopeLocationCollection(
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
        $conditions = new AntelopeLocationConditionTransfer();
        $this->antelopeLocationsExpander->expandWithFilters($conditions,
            $glueRequestTransfer);
        $antelopeLocationCriteriaTransfer->setPagination($glueRequestTransfer->getPagination())
            ->setSortCollection($glueRequestTransfer->getSortings())
            ->setAntelopeLocationsConditions($conditions);

        return $this->getAntelopeLocationCollectionTransfer($antelopeLocationCriteriaTransfer);
    }
}
