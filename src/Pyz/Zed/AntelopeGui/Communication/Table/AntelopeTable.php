<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeGui\Communication\Table;

use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeTableMap;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AntelopeTable extends AbstractTable
{
    public const string COL_ID_ANTELOPE = PyzAntelopeTableMap::COL_ID_ANTELOPE;
    public const string COL_NAME = PyzAntelopeTableMap::COL_NAME;
    public const string COL_ANTELOPE_LOCATION_NAME = PyzAntelopeTableMap::COL_FK_ANTELOPE_LOCATION;


    public function __construct(protected PyzAntelopeQuery $antelopeQuery)
    {
    }

    /**
     * @param TableConfiguration $config
     *
     * @return TableConfiguration
     */
    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config->setHeader([
            static::COL_ID_ANTELOPE => 'Antelope ID',
            static::COL_NAME => 'Name',
            static::COL_ANTELOPE_LOCATION_NAME => 'Location Name',

        ]);

        $config->setSortable([
            static::COL_ID_ANTELOPE,
            static::COL_NAME,
            static::COL_ANTELOPE_LOCATION_NAME,

        ]);

        $config->setSearchable([
            static::COL_ID_ANTELOPE,
            static::COL_NAME,
            static::COL_ANTELOPE_LOCATION_NAME,
        ]);

        return $config;
    }

    /**
     * @param TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config): array
    {
        $antelopeEntityCollection = $this->runQuery(
            $this->antelopeQuery,
            $config,
            true
        );

        if (!$antelopeEntityCollection->count()) {
            return [];
        }

        return $this->mapReturns($antelopeEntityCollection);
    }

    /**
     * @param ObjectCollection<PyzAntelope> $antelopeEntityCollection
     *
     * @return array<int,mixed>
     */
    protected function mapReturns(ObjectCollection $antelopeEntityCollection
    ): array {
        $returns = [];

        foreach ($antelopeEntityCollection as $antelopeEntity) {
            $returns[] = [
                static::COL_ID_ANTELOPE => $antelopeEntity->getIdAntelope(),
                static::COL_NAME => $antelopeEntity->getName(),
                static::COL_ANTELOPE_LOCATION_NAME => $antelopeEntity->getPyzAntelopeLocation()?->getLocationName()
            ];
        }

        return $returns;
    }
}
