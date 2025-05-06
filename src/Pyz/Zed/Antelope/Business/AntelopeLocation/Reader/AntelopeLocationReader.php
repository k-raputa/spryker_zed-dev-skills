<?php

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Reader;

use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;

class AntelopeLocationReader
{
    public function __construct(
        protected AntelopeRepositoryInterface $antelopeRepository
    ) {
    }

    public function getAntelopeLocationById(
        int $antelopeLocationId,
    ): AntelopeLocationResponseTransfer {
        $antelopeLocationTransfer = $this->antelopeRepository->getAntelopeLocationById($antelopeLocationId);
        $antelopeLocationResponseTransfer = new AntelopeLocationResponseTransfer();
        $antelopeLocationResponseTransfer->setIsSuccessFul(false);
        if ($antelopeLocationTransfer) {
            $antelopeLocationResponseTransfer->setAntelopeLocation($antelopeLocationTransfer);
            $antelopeLocationResponseTransfer->setIsSuccessFul(true);
        }
        return $antelopeLocationResponseTransfer;
    }
}
