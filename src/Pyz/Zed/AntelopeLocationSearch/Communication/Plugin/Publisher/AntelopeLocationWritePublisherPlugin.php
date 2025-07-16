<?php

namespace Pyz\Zed\AntelopeLocationSearch\Communication\Plugin\Publisher;

use Pyz\Shared\AntelopeLocationSearch\AntelopeLocationSearchConfig;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface;

/**
 * @method \Pyz\Zed\AntelopeLocationSearch\Business\AntelopeLocationSearchFacadeInterface getFacade()
 */
class AntelopeLocationWritePublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventEntityTransfers, $eventName)
    {
        $this->getFacade()
            ->writeCollectionByAntelopeLocationEvents($eventEntityTransfers);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string[]
     */
    public function getSubscribedEvents(): array
    {
        return [
            AntelopeLocationSearchConfig::ANTELOPE_LOCATION_PUBLISH,
            AntelopeLocationSearchConfig::ENTITY_PYZ_ANTELOPE_LOCATION_CREATE,
            AntelopeLocationSearchConfig::ENTITY_PYZ_ANTELOPE_LOCATION_UPDATE,
        ];
    }
}
