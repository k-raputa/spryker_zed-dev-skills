<?php

namespace Pyz\Zed\AntelopeLocationSearch\Business;

interface AntelopeLocationSearchFacadeInterface
{
    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfers
     *
     * @return void
     */
    public function writeCollectionByAntelopeLocationEvents(array $eventTransfers): void;
}
