<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopeLocationsBackendApi;

use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Creator\AntelopeLocationCreator;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Creator\AntelopeLocationCreatorInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Deleter\AntelopeLocationDeleter;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Expander\AntelopeLocationExpander;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Expander\AntelopeLocationExpanderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Mapper\AntelopeLocationMapper;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Mapper\AntelopeLocationMapperInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Reader\AntelopeLocationReader;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Reader\AntelopeLocationReaderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilder;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\ErrorResponseBuilder;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\ErrorResponseBuilderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Updater\AntelopeLocationUpdater;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Updater\AntelopeUpdaterInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Spryker\Glue\Kernel\Backend\AbstractFactory;

class AntelopeLocationsBackendApiFactory extends AbstractFactory
{
    public function createAntelopeLocationReader(): AntelopeLocationReaderInterface
    {
        return new AntelopeLocationReader(
            $this->getAntelopeFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createAntelopeLocationExpander(),
            $this->createErrorResponseBuilder(),
        );
    }

    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeLocationsBackendApiDependencyProvider::FACADE_ANTELOPE);
    }

    public function createAntelopeLocationResponseBuilder(): AntelopeLocationResponseBuilderInterface
    {
        return new AntelopeLocationResponseBuilder();
    }

    public function createAntelopeLocationExpander(): AntelopeLocationExpanderInterface
    {
        return new AntelopeLocationExpander();
    }

    private function createErrorResponseBuilder(): ErrorResponseBuilderInterface
    {
        return new ErrorResponseBuilder();
    }

    public function createAntelopeLocationWriter(): AntelopeLocationCreatorInterface
    {
        return new AntelopeLocationCreator(
            $this->getAntelopeFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createAntelopeLocationMapper(),
        );
    }

    public function createAntelopeLocationMapper(): AntelopeLocationMapperInterface
    {
        return new AntelopeLocationMapper();
    }

    public function createAntelopeLocationUpdater(): AntelopeUpdaterInterface
    {
        return new AntelopeLocationUpdater(
            $this->getAntelopeFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createAntelopeLocationMapper(),
        );
    }

    public function createAntelopeLocationDeleter(): AntelopeLocationDeleter
    {
        return new AntelopeLocationDeleter(
            $this->getAntelopeFacade(),
            $this->createAntelopeLocationResponseBuilder(),
            $this->createErrorResponseBuilder(),
        );
    }
}
