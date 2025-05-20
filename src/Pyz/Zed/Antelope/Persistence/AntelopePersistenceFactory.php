<?php

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;

use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use Pyz\Zed\Antelope\Persistence\Propel\Mapper\AntelopeLocationMapper;
use Pyz\Zed\Antelope\Persistence\Propel\Mapper\AntelopeMapper;

class AntelopePersistenceFactory extends AbstractPersistenceFactory
{
    public function createAntelopeQuery(): PyzAntelopeQuery
    {
        return PyzAntelopeQuery::create();
    }

    public function createAntelopeLocationQuery(): PyzAntelopeLocationQuery
    {
        return PyzAntelopeLocationQuery::create();
    }

    public function createAntelopeLocationMapper(): AntelopeLocationMapper
    {
        return new AntelopeLocationMapper();
    }
}
