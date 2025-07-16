<?php

namespace Pyz\Zed\AntelopeLocationSearch\Persistence;

use Generated\Shared\Transfer\AntelopeLocationSearchTransfer;
use Orm\Zed\AntelopeLocationSearch\Persistence\PyzAntelopeLocationSearch;
use Pyz\Zed\AntelopeLocationSearch\Persistence\Exception\AntelopeLocationSearchNotFoundException;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchPersistenceFactory getFactory()
 */
class AntelopeLocationSearchEntityManager extends AbstractEntityManager implements AntelopeLocationSearchEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeLocationSearchTransfer
     */
    public function createAntelopeLocationSearch(
        AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer
    ): AntelopeLocationSearchTransfer {
        $antelopeLocationSearchEntity = $this->getFactory()
            ->createAntelopeLocationSearchMapper()
            ->mapAntelopeLocationSearchTransferToAntelopeLocationSearchEntity(
                $antelopeLocationSearchTransfer,
                new PyzAntelopeLocationSearch(),
            );

        $antelopeLocationSearchEntity->save();

        return $this->getFactory()
            ->createAntelopeLocationSearchMapper()
            ->mapAntelopeLocationSearchEntityToAntelopeLocationSearchTransfer($antelopeLocationSearchEntity, $antelopeLocationSearchTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer
     *
     * @throws \Pyz\Zed\AntelopeLocationSearch\Persistence\Exception\AntelopeLocationSearchNotFoundException
     *
     * @return \Generated\Shared\Transfer\AntelopeLocationSearchTransfer
     */
    public function updateAntelopeLocationSearch(
        AntelopeLocationSearchTransfer $antelopeLocationSearchTransfer
    ): AntelopeLocationSearchTransfer {
        $antelopeLocationSearchEntity = $this->getFactory()
            ->createAntelopeLocationSearchQuery()
            ->filterByIdAntelopeLocationSearch($antelopeLocationSearchTransfer->getIdAntelopeLocationSearch())
            ->findOne();

        if ($antelopeLocationSearchEntity === null) {
            throw new AntelopeLocationSearchNotFoundException(
                sprintf(
                    'AntelopeLocationSearch was not found by given id %s',
                    $antelopeLocationSearchTransfer->getIdAntelopeLocationSearch(),
                ),
            );
        }

        $antelopeLocationSearchEntity = $this->getFactory()
            ->createAntelopeLocationSearchMapper()
            ->mapAntelopeLocationSearchTransferToAntelopeLocationSearchEntity(
                $antelopeLocationSearchTransfer,
                $antelopeLocationSearchEntity,
            );

        $antelopeLocationSearchEntity->save();

        return $this->getFactory()
            ->createAntelopeLocationSearchMapper()
            ->mapAntelopeLocationSearchEntityToAntelopeLocationSearchTransfer($antelopeLocationSearchEntity, $antelopeLocationSearchTransfer);
    }
}
