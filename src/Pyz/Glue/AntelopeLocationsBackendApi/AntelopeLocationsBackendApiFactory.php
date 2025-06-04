<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi;

use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Creator\AntelopeLocationCreator;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Creator\AntelopeLocationCreatorInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Deleter\AntelopeLocationDeleterInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Expander\AntelopeLocationExpander;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Expander\AntelopeLocationExpanderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Mapper\AntelopeLocationMapper;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Mapper\AntelopeLocationMapperInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilder;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Reader\AntelopeLocationReader;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Updater\AntelopeLocationUpdater;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Updater\AntelopeLocationUpdaterInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Deleter\AntelopeLocationDeleter;

use Spryker\Glue\Kernel\Backend\AbstractFactory;

class AntelopeLocationsBackendApiFactory extends AbstractFactory
{
    public function createAntelopeLocationReader()
    {
        return new AntelopeLocationReader(
            $this->getAntelopeFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createAntelopeLocationsExpander(),
        );
    }

    public function createAntelopeLocationWriter(): AntelopeLocationCreatorInterface
    {
        return new AntelopeLocationCreator(
            $this->getAntelopeFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createAntelopeLocationMapper(),
        );
    }

    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeLocationsBackendApiDependencyProvider::FACADE_ANTELOPE);
    }

    public function createAntelopeLocationMapper(): AntelopeLocationMapperInterface
    {
        return new AntelopeLocationMapper();
    }

    public function createAntelopeLocationUpdater(): AntelopeLocationUpdaterInterface
    {
        return new AntelopeLocationUpdater(
            $this->getAntelopeFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createAntelopeLocationMapper(),
        );
    }

    public function createAntelopeLocationDeleter(): AntelopeLocationDeleterInterface
    {
        return new AntelopeLocationDeleter(
            $this->getAntelopeFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createAntelopeLocationMapper());
    }

    public function createAntelopeLocationResponseBuilder(): AntelopeLocationResponseBuilderInterface
    {
        return new AntelopeLocationResponseBuilder();
    }

    public function createAntelopeLocationsExpander(): AntelopeLocationExpanderInterface
    {
        return new AntelopeLocationExpander();
    }
}
