<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Plugin;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiConfig;
use Pyz\Glue\AntelopeLocationsBackendApi\Controller\AntelopeLocationsResourceController;
use Spryker\Glue\GlueApplication\Plugin\GlueApplication\Backend\AbstractResourcePlugin;
use Spryker\Glue\GlueJsonApiConventionExtension\Dependency\Plugin\JsonApiResourceInterface;

class AntelopeLocationsBackendApiResourcePlugin extends AbstractResourcePlugin implements JsonApiResourceInterface
{
    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return AntelopeLocationsBackendApiConfig::RESOURCE_ANTELOPE_LOCATIONS;
    }

    /**
     * @inheritDoc
     */
    public function getController(): string
    {
        return AntelopeLocationsResourceController::class;
    }

    /**
     * @inheritDoc
     */
    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        $attributes = AntelopeLocationsBackendApiAttributesTransfer::class;

        return (new GlueResourceMethodCollectionTransfer())
            ->setGetCollection((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setPost((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setGet((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setPatch((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setDelete(new GlueResourceMethodConfigurationTransfer());
    }
}
