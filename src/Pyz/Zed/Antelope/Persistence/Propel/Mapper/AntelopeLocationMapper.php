<?php

namespace Pyz\Zed\Antelope\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocation;

class AntelopeLocationMapper
{
    public function mapAntelopeLocationEntitiesToCollectionTransfer(
        iterable $pyzAntelopeLocationCollection,
    ): AntelopeLocationCollectionTransfer {
        $antelopeLocationCollectionTransfer = new AntelopeLocationCollectionTransfer();
        foreach ($pyzAntelopeLocationCollection as $pyzAntelopeLocation) {
            $antelopeLocationTransfer = $this->mapAntelopeLocationEntityToTransfer(
                $pyzAntelopeLocation,
                new AntelopeLocationTransfer(),
            );
            $antelopeLocationCollectionTransfer->addAntelopeLocation($antelopeLocationTransfer);
        }

        return $antelopeLocationCollectionTransfer;
    }

    public function mapAntelopeLocationEntityToTransfer(
        PyzAntelopeLocation $entity,
        AntelopeLocationTransfer $transfer,
    ): AntelopeLocationTransfer {
        return $transfer->fromArray($entity->toArray(), true);
    }
}
