<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Reader;

use ArrayObject;
use Generated\Shared\Transfer\AntelopeLocationConditionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Expander\AntelopeLocationExpanderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\ErrorResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Symfony\Component\HttpFoundation\Response;

class AntelopeLocationReader implements AntelopeLocationReaderInterface
{
    public function __construct(
        private readonly AntelopeFacadeInterface $antelopeFacade,
        private readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        private readonly AntelopeLocationExpanderInterface $antelopeLocationExpander,
        private readonly ErrorResponseBuilderInterface $errorResponseBuilder,

    ) {
    }

    public function getAntelopeLocation(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
        $conditions = new AntelopeLocationConditionTransfer();
        //dd($glueRequestTransfer->getResource());
        $conditions->setIdAntelopeLocation((int)$glueRequestTransfer->getResource()?->getId());
        $antelopeLocationCriteriaTransfer->setAntelopeLocationsConditions($conditions);

        return $this->getAntelopeLocationCollectionTransfer($antelopeLocationCriteriaTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer $antelopeCriteriaTransfer
     *
     * @return GlueResponseTransfer
     */
    public function getAntelopeLocationCollectionTransfer(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer,
    ): GlueResponseTransfer {
        $antelopeLocationCollectionTransfer = $this->antelopeFacade
            ->getAntelopeLocationCollection($antelopeLocationCriteriaTransfer);
        if (!$antelopeLocationCollectionTransfer->getAntelopeLocations()->count()) {
            return $this->respondWithErrors();
        }
        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse(
            $antelopeLocationCollectionTransfer,
        );
    }

    public function getAntelopeLocationCollection(
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
        $conditions = new AntelopeLocationConditionTransfer();
        $this->antelopeLocationExpander->expandWithFilters(
            $conditions,
            $glueRequestTransfer,
        );
        $antelopeLocationCriteriaTransfer->setPagination($glueRequestTransfer->getPagination())
            ->setSortCollection($glueRequestTransfer->getSortings())
            ->setAntelopeLocationsConditions($conditions);

        return $this->getAntelopeLocationCollectionTransfer($antelopeLocationCriteriaTransfer);
    }

    /**
     * @return GlueResponseTransfer
     */
    public function respondWithErrors(): GlueResponseTransfer
    {
        $errorTransfer = new ErrorTransfer();
        $errorTransfer->setMessage('Antelope location not found');
        $errorTransfer->setParameters(
            ['status' => Response::HTTP_NOT_FOUND, 'message' => 'Antelope location not found'],
        );
        $errorTransfers = new ArrayObject();
        $errorTransfers->append($errorTransfer);
        return $this->errorResponseBuilder->createErrorResponse(
            $errorTransfers,
        );
    }
}
