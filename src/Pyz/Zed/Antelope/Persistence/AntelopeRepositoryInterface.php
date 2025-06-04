<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
interface AntelopeRepositoryInterface
{
    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer,
    ): AntelopeTransfer;

    public function findAntelopeLocationCollection(
        AntelopeLocationCriteriaTransfer $criteriaTransfer,
    ): AntelopeLocationCollectionTransfer;

    public function getAntelopeCollection(AntelopeCriteriaTransfer $antelopeCriteriaTransfer): AntelopeCollectionTransfer;

    public function getAntelopeLocationsCollection(): AntelopeLocationCollectionTransfer;
}
