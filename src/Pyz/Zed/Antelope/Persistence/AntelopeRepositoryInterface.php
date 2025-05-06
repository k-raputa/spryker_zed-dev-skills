<?php

namespace Pyz\Zed\Antelope\Persistence;


use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
interface AntelopeRepositoryInterface
{
    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): ?AntelopeTransfer;

    public function getAntelopeLocationById(int $antelopeLocationId
    ): ?AntelopeLocationTransfer;
}
