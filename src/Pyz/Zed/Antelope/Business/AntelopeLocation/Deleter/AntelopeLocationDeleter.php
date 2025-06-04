<?php
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
