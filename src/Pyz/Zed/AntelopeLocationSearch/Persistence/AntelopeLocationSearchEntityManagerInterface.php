<?php

namespace Pyz\Zed\AntelopeLocationSearch\Persistence;

use Generated\Shared\Transfer\AntelopeLocationSearchTransfer;

interface AntelopeLocationSearchEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeLocationSearchTransfer
     */
    public function createAntelopeLocationSearch(AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer): AntelopeLocationSearchTransfer;

    /**
     * @param \Generated\Shared\Transfer\AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer
     *
     * @throws \Pyz\Zed\AntelopeLocationSearch\Persistence\Exception\AntelopeLocationSearchNotFoundException
     *
     * @return \Generated\Shared\Transfer\AntelopeLocationSearchTransfer
     */
    public function updateAntelopeLocationSearch(AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer): AntelopeLocationSearchTransfer;
}
