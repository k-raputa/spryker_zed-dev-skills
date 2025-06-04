<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Business\Antelope\Reader;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeBusinessFactory getFactory()
 */
class AntelopeReader
{
    public function __construct(
        protected AntelopeRepositoryInterface $antelopeRepository,
    ) {
    }

    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer,
    ): AntelopeResponseTransfer {
        $antelopeTransfer = $this->antelopeRepository->getAntelope($antelopeCriteriaTransfer);

        $antelopeResponseTransfer = new AntelopeResponseTransfer();
        $antelopeResponseTransfer->setAntelope($antelopeTransfer);
        $antelopeResponseTransfer->setIsSuccessful(true);

        return $antelopeResponseTransfer;
    }

    public function getAntelopeCollection(AntelopeCriteriaTransfer $antelopeCriteriaTransfer): AntelopeCollectionTransfer
    {
        $antelopeTransfers = $this->antelopeRepository->getAntelopeCollection($antelopeCriteriaTransfer);

        $antelopeCollectionTransfer = new AntelopeCollectionTransfer();
        $antelopeCollectionTransfer->setAntelopes($antelopeTransfers->getAntelopes());

        return $antelopeCollectionTransfer;
    }
}
