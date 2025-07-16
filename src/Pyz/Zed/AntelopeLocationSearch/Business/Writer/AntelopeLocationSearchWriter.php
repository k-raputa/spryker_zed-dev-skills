<?php

namespace Pyz\Zed\AntelopeLocationSearch\Business\Writer;

use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery;
use Orm\Zed\AntelopeLocationSearch\Persistence\PyzAntelopeLocationSearchQuery;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationSearchCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationSearchTransfer;
use Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchEntityManagerInterface;
use Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchRepositoryInterface;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class AntelopeLocationSearchWriter
{
    /**
     * @var \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    protected $eventBehaviorFacade;

    /**
     * @var \Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchRepositoryInterface
     */
    protected $antelopeLocationSearchRepository;

    /**
     * @var \Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchEntityManagerInterface
     */
    protected $antelopeLocationSearchEntityManager;

    /**
     * @param \Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface $eventBehaviorFacade
     * @param \Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchRepositoryInterface $antelopeLocationSearchRepository
     * @param \Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchEntityManagerInterface $antelopeLocationSearchEntityManager
     */
    public function __construct(
        EventBehaviorFacadeInterface $eventBehaviorFacade,
        AntelopeLocationSearchRepositoryInterface $antelopeLocationSearchRepository,
        AntelopeLocationSearchEntityManagerInterface $antelopeLocationSearchEntityManager
    ) {
        $this->eventBehaviorFacade = $eventBehaviorFacade;
        $this->antelopeLocationSearchRepository = $antelopeLocationSearchRepository;
        $this->antelopeLocationSearchEntityManager = $antelopeLocationSearchEntityManager;
    }

    public function writeCollectionByAntelopeLocationEvents(array $eventTransfers): void
    {
        $antelopeIds = $this->eventBehaviorFacade->getEventTransferIds($eventTransfers);

        $this->writeCollectionByAntelopeIds($antelopeIds);
    }

    protected function writeCollectionByAntelopeLocationIds(array $antelopeLocationIds): void
    {
        if (!$antelopeLocationIds) {
            return;
        }

        foreach ($antelopeLocationIds as $antelopeLocationId) {
            $antelopeLocationEntity = PyzAntelopeLocationQuery::create()
                ->filterByIdAntelopeLocation($antelopeLocationId)
                ->findOne();

            $searchEntity = PyzAntelopeLocationSearchQuery::create()
                ->filterByFkAntelopeLocation($antelopeLocationId)
                ->findOneOrCreate();
            $searchEntity->setFkAntelopeLocation($antelopeLocationId);

            $searchData = $antelopeLocationEntity->toArray();
            $searchEntity->setData($searchData);

            $searchEntity->save();
        }
        $antelopeLocationTransfersIndexed = $this->getAntelopeLocationTransfersIndexed($antelopeLocationIds);
        $antelopeLocationSearchTransfersIndexed = $this->getAntelopeLocationSearchTransfersIndexed(array_keys($antelopeLocationTransfersIndexed));

        foreach ($antelopeLocationTransfersIndexed as $antelopeLocationId => $antelopeLocationTransfer) {
            $searchData = $antelopeLocationTransfer->toArray();

            $antelopeLocationSearchTransfer = $antelopeLocationSearchTransfersIndexed[$antelopeLocationId] ?? new AntelopeLocationSearchTransfer();

            $antelopeLocationSearchTransfer
                ->setFkAntelopeLocation($antelopeLocationId)
                ->setData($searchData);

            if ($antelopeLocationSearchTransfer->getIdAntelopeLocationSearch() === null) {
                $this->antelopeLocationSearchEntityManager->createAntelopeLocationSearch($antelopeLocationSearchTransfer);

                continue;
            }

            $this->antelopeLocationSearchEntityManager->updateAntelopeLocationSearch($antelopeLocationSearchTransfer);
        }
    }

    /**
     * @param int[] $antelopeLocationIds
     *
     * @return \Generated\Shared\Transfer\AntelopeLocationSearchTransfer[]
     */
    protected function getAntelopeLocationSearchTransfersIndexed(array $antelopeLocationIds): array
    {
        $antelopeLocationSearchCriteriaTransfer = (new AntelopeLocationSearchCriteriaTransfer())
            ->setFksAntelopeLocation($antelopeLocationIds);

        $antelopeLocationSearchTransfers = $this->antelopeLocationSearchRepository
            ->getAntelopeLocationSearches($antelopeLocationSearchCriteriaTransfer);

        $antelopeLocationSearchTransfersIndexed = [];
        foreach ($antelopeLocationSearchTransfers as $antelopeLocationSearchTransfer) {
            $antelopeLocationSearchTransfersIndexed[$antelopeLocationSearchTransfer->getFkAntelopeLocation()] = $antelopeLocationSearchTransfer;
        }

        return $antelopeLocationSearchTransfersIndexed;
    }

    /**
     * @param int[] $antelopeLocationIds
     *
     * @return \Generated\Shared\Transfer\AntelopeLocationTransfer[]
     */
    protected function getAntelopeLocationTransfersIndexed(array $antelopeLocationIds): array
    {
        $antelopeLocationCriteriaTransfer = (new AntelopeLocationCriteriaTransfer())
            ->setIdsAntelopeLocation($antelopeLocationIds);

        $antelopeLocationTransfers = $this->antelopeLocationSearchRepository
            ->getAntelopeLocations($antelopeLocationCriteriaTransfer);

        $antelopeLocationTransfersIndexed = [];
        foreach ($antelopeLocationTransfers as $antelopeLocationTransfer) {
            $antelopeLocationTransfersIndexed[$antelopeLocationTransfer->getIdAntelopeLocation()] = $antelopeLocationTransfer;
        }

        return $antelopeLocationTransfersIndexed;
    }
}
