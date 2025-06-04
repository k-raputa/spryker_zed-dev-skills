<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopesBackendApi\Processor\Reader;

use Generated\Shared\Transfer\AntelopeConditionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\Processor\Expander\AntelopeExpanderInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeReader implements AntelopeReaderInterface
{
    public function __construct(
        private readonly AntelopeFacadeInterface $antelopeFacade,
        private readonly AntelopeResponseBuilderInterface $antelopeResponseBuilder,
        private readonly AntelopeExpanderInterface $antelopesExpander,
    ) {
    }

    public function getAntelope(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        $conditions = new AntelopeConditionTransfer();
        $conditions->setIdAntelope((int)$glueRequestTransfer->getResource()?->getId());
        $antelopeCriteriaTransfer->setAntelopeConditions($conditions);

        return $this->getAntelopeCollectionTransfer($antelopeCriteriaTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeCriteriaTransfer $antelopeCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function getAntelopeCollectionTransfer(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer,
    ): GlueResponseTransfer {
        $antelopeCollectionTransfer = $this->antelopeFacade
            ->getAntelopeCollection($antelopeCriteriaTransfer);

        return $this->antelopeResponseBuilder->createAntelopeResponse($antelopeCollectionTransfer);
    }

    public function getAntelopeCollection(
        GlueRequestTransfer $glueRequestTransfer,
    ): GlueResponseTransfer {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        $conditions = new AntelopeConditionTransfer();
        $this->antelopesExpander->expandWithFilters(
            $conditions,
            $glueRequestTransfer,
        );
        $antelopeCriteriaTransfer->setPagination($glueRequestTransfer->getPagination())
            ->setSortCollection($glueRequestTransfer->getSortings())
            ->setAntelopeConditions($conditions);

        return $this->getAntelopeCollectionTransfer($antelopeCriteriaTransfer);
    }
}
