<?php

namespace Pyz\Zed\AntelopeLocationSearch\Persistence;

use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery;
use Orm\Zed\AntelopeLocationSearch\Persistence\PyzAntelopeLocationSearchQuery;
use Pyz\Zed\AntelopeLocationSearch\AntelopeLocationSearchDependencyProvider;
use Pyz\Zed\AntelopeLocationSearch\Persistence\Propel\AntelopeLocationSearch\Mapper\AntelopeLocationSearchMapper;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchRepositoryInterface getRepository()
 * @method \Pyz\Zed\AntelopeLocationSearch\Persistence\AntelopeLocationSearchEntityManagerInterface getEntityManager()
 */
class AntelopeLocationSearchPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\AntelopeLocationSearch\Persistence\PyzAntelopeLocationSearchQuery
     */
    public function createAntelopeLocationSearchQuery(): PyzAntelopeLocationSearchQuery
    {
        return PyzAntelopeLocationSearchQuery::create();
    }

    /**
     * @return \Pyz\Zed\AntelopeLocationSearch\Persistence\Propel\AntelopeLocationSearch\Mapper\AntelopeLocationSearchMapper
     */
    public function createAntelopeLocationSearchMapper(): AntelopeLocationSearchMapper
    {
        return new AntelopeLocationSearchMapper();
    }

    /**
     * @return \Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery
     */
    public function getAntelopeLocationPropelQuery(): PyzAntelopeLocationQuery
    {
        return $this->getProvidedDependency(AntelopeLocationSearchDependencyProvider::PROPEL_QUERY_ANTELOPE_LOCATION);
    }
}
