<?php

namespace Pyz\Zed\AntelopeLocationSearch\Persistence;

use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationSearchCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationSearchTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchPersistenceFactory getFactory()
 */
class AntelopeLocationSearchRepository extends AbstractRepository implements AntelopeLocationSearchRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeLocationTransfer[]
     */
    public function getAntelopeLocations(AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer): array
    {
        $antelopeEntities = $this->getFactory()
            ->getAntelopeLocationPropelQuery()
            ->filterByIdAntelopeLocation_In($antelopeLocationCriteriaTransfer->getIdsAntelopeLocation())
            ->find();

        $antelopeTransfers = [];

        foreach ($antelopeEntities as $antelopeEntity) {
            $antelopeTransfers[] = (new AntelopeLocationTransfer())
                ->fromArray($antelopeEntity->toArray(), true);
        }

        return $antelopeTransfers;
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeLocationSearchCriteriaTransfer $antelopeLocationSearchCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeLocationSearchTransfer[]
     */
    public function getAntelopeLocationSearches(AntelopeLocationSearchCriteriaTransfer $antelopeLocationSearchCriteriaTransfer): array
    {
        $antelopeLocationSearchEntities = $this->getFactory()
            ->createAntelopeLocationSearchQuery()
            ->filterByfkAntelopeLocation_In($antelopeLocationSearchCriteriaTransfer->getFksAntelopeLocation())
            ->find();

        $antelopeLocationSearchTransfers = [];

        foreach ($antelopeLocationSearchEntities as $antelopeLocationSearchEntity) {
            $antelopeLocationSearchTransfers[] = $this->getFactory()
                ->createAntelopeLocationSearchMapper()
                ->mapAntelopeLocationSearchEntityToAntelopeLocationSearchTransfer($antelopeLocationSearchEntity, new AntelopeLocationSearchTransfer());
        }

        return $antelopeLocationSearchTransfers;
    }
}
