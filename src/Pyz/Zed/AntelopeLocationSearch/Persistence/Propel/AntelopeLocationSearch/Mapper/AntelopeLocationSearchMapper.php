<?php

namespace Pyz\Zed\AntelopeLocationSearch\Persistence\Propel\AntelopeLocationSearch\Mapper;

use Generated\Shared\Transfer\AntelopeLocationSearchTransfer;
use Orm\Zed\AntelopeLocationSearch\Persistence\PyzAntelopeLocationSearch;

class AntelopeLocationSearchMapper
{
    /**
     * @param \Generated\Shared\Transfer\AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer
     * @param \Orm\Zed\AntelopeLocationSearch\Persistence\PyzAntelopeLocationSearch $antelopeLocationSearchEntity
     *
     * @return \Orm\Zed\AntelopeLocationSearch\Persistence\PyzAntelopeLocationSearch
     */
    public function mapAntelopeLocationSearchTransferToAntelopeLocationSearchEntity(
        AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer,
        PyzAntelopeLocationSearch $antelopeLocationSearchEntity
    ): PyzAntelopeLocationSearch {
        return $antelopeLocationSearchEntity->fromArray($antelopeLocationSearchTransfer->modifiedToArray());
    }

    /**
     * @param \Orm\Zed\AntelopeLocationSearch\Persistence\PyzAntelopeLocationSearch $antelopeLocationSearchEntity
     * @param \Generated\Shared\Transfer\AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeLocationSearchTransfer
     */
    public function mapAntelopeLocationSearchEntityToAntelopeLocationSearchTransfer(
        PyzAntelopeLocationSearch $antelopeLocationSearchEntity,
        AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer
    ): AntelopeLocationSearchTransfer {
        return $antelopeLocationSearchTransfer->fromArray($antelopeLocationSearchEntity->toArray(), true);
    }
}
