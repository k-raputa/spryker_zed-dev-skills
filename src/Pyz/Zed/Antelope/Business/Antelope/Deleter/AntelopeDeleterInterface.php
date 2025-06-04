<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Business\Antelope\Deleter;

use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeDeleterInterface
{
    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): int;
}
