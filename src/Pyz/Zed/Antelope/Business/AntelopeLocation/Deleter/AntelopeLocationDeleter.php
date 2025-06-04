<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Deleter;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;

class AntelopeLocationDeleter
{
    public function __construct(protected AntelopeEntityManagerInterface $antelopeEntityManager)
    {
    }

    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): int
    {
        return $this->antelopeEntityManager->deleteAntelopeLocation($antelopeLocationTransfer);
    }
}
