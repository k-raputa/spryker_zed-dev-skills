<?php

namespace Pyz\Zed\AntelopeLocationSearch\Persistence;

use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationSearchCriteriaTransfer;

interface AntelopeLocationSearchRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeLocationTransfer[]
     */
    public function getAntelopeLocations(AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer): array;

    /**
     * @param \Generated\Shared\Transfer\AntelopeLocationSearchCriteriaTransfer $antelopeLocationSearchCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeLocationSearchTransfer[]
     */
    public function getAntelopeLocationSearches(AntelopeLocationSearchCriteriaTransfer $antelopeLocationSearchCriteriaTransfer): array;
}
