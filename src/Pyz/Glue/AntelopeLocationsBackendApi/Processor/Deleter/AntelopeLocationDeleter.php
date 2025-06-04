<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Deleter;

use ArrayObject;
use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\ErrorResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Symfony\Component\HttpFoundation\Response;

class AntelopeLocationDeleter implements AntelopeLocationDeleterInterface
{
    /**
     * @param \Pyz\Zed\Antelope\Business\AntelopeFacadeInterface $antelopeFacade
     * @param \Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder
     * @param \Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\ErrorResponseBuilderInterface $errorResponseBuilder
     */
    public function __construct(
        protected readonly AntelopeFacadeInterface $antelopeFacade,
        protected readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
        private readonly ErrorResponseBuilderInterface $errorResponseBuilder,
    ) {
    }

    public function deleteAntelopeLocation(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeLocationTransfer = (new AntelopeLocationTransfer())->setIdAntelopeLocation(
            (int)$glueRequestTransfer->getResource()?->getId(),
        );
        $res = $this->antelopeFacade->deleteAntelopeLocation($antelopeLocationTransfer);
        if (!$res) {
            $errorTransfer = new ErrorTransfer();
            $errorTransfer->setMessage('Antelope not found');
            $errorTransfer->setParameters(
                ['code' => Response::HTTP_NOT_FOUND, 'message' => 'Antelope location not found'],
            );
            $errorTransfers = new ArrayObject();
            $errorTransfers->append($errorTransfer);

            return $this->errorResponseBuilder->createErrorResponse($errorTransfers);
        }

        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse(
            new AntelopeLocationCollectionTransfer(),
        );
    }
}
