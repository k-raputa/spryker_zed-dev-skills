<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopesBackendApi\Processor\Deleter;

use ArrayObject;
use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\Processor\Mapper\AntelopeMapperInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\ErrorResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Symfony\Component\HttpFoundation\Response;

class AntelopeDeleter implements AntelopeDeleterInterface
{
 /**
  * @param \Pyz\Zed\Antelope\Business\AntelopeFacadeInterface $antelopeFacade
  * @param \Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface $antelopeResponseBuilder
  * @param \Pyz\Glue\AntelopesBackendApi\Processor\Mapper\AntelopeMapperInterface $antelopeMapper
  */
    public function __construct(
        protected readonly AntelopeFacadeInterface $antelopeFacade,
        protected readonly AntelopeResponseBuilderInterface $antelopeResponseBuilder,
        protected readonly AntelopeMapperInterface $antelopeMapper,
        protected readonly ErrorResponseBuilderInterface $errorResponseBuilder,
    ) {
    }

    public function deleteAntelope(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeTransfer = (new AntelopeTransfer())->setIdAntelope((int)$glueRequestTransfer->getResource()?->getId());
        $res = $this->antelopeFacade->deleteAntelope($antelopeTransfer);
        if (!$res) {
            $errorTransfer = new ErrorTransfer();
            $errorTransfer->setMessage('Antelope not found');
            $errorTransfer->setParameters(['code' => Response::HTTP_NOT_FOUND, 'message' => 'Antelope not found']);
            $errorTransfers = new ArrayObject();
            $errorTransfers->append($errorTransfer);

            return $this->errorResponseBuilder->createErrorResponse($errorTransfers);
        }

        return $this->antelopeResponseBuilder->createAntelopeResponse(new AntelopeCollectionTransfer());
    }
}
