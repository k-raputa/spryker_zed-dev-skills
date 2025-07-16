<?php

namespace Pyz\Zed\AntelopeLocationSearch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\AntelopeLocationSearch\Business\AntelopeLocationSearchBusinessFactory getFactory()
 */
class AntelopeLocationSearchFacade extends AbstractFacade implements AntelopeLocationSearchFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfers
     *
     * @return void
     */
    public function writeCollectionByAntelopeLocationEvents(array $eventTransfers): void
    {
        $this->getFactory()
            ->createAntelopeLocationSearchWriter()
            ->writeCollectionByAntelopeLocationEvents($eventTransfers);
    }
}
