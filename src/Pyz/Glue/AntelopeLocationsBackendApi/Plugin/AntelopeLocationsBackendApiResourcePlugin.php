<?php declare(strict_types=1);


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
        $collection = new GlueResourceMethodCollectionTransfer();
        $method = new GlueResourceMethodConfigurationTransfer();
        $attributes = AntelopeLocationsBackendApiAttributesTransfer::class;
        $method->setAttributes($attributes);

        $collection->setGetCollection($method);

        $collection->setGet((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setPost((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setPut((new GlueResourceMethodConfigurationTransfer())->setAttributes($attributes))
            ->setDelete(new GlueResourceMethodConfigurationTransfer());

        return $collection;
    }
}
