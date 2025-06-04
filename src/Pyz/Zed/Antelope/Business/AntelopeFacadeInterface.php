<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Business;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeBusinessFactory getFactory()
 */
interface AntelopeFacadeInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer;

    public function createAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer;

    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer,
    ): AntelopeResponseTransfer;

    public function getAntelopeLocationById(
        int $idLocation,
    ): ?AntelopeLocationTransfer;

    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteria,
    ): AntelopeLocationResponseTransfer;

    public function getAntelopeLocationCollection(AntelopeLocationCriteriaTransfer $criteriaTransfer
    ): AntelopeLocationCollectionTransfer;

    public function getAntelopeCollection(AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeCollectionTransfer;

    public function getAntelopeLocations(): AntelopeLocationCollectionTransfer;

    public function updateAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer;

    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): int;

    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): int;

    public function updateAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationTransfer;
}
