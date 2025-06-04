<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Writer;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;

class AntelopeLocationWriter
{
    public function __construct(
        protected AntelopeEntityManagerInterface $entityManager,
    ) {
    }

    public function createAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer {
        return $this->entityManager->createAntelopeLocation($antelopeLocationTransfer);
    }
}
