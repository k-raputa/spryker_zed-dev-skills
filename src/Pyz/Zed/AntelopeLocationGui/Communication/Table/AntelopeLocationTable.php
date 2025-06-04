<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationGui\Communication\Table;

use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeLocationTableMap;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AntelopeLocationTable extends AbstractTable
{
    public const string COL_LOCATION_NAME = PyzAntelopeLocationTableMap::COL_LOCATION_NAME;

    public const string COL_ID_ANTELOPE_LOCATION = PyzAntelopeLocationTableMap::COL_ID_ANTELOPE_LOCATION;

    /**
     * @var string
     */
    public const string COL_ACTIONS = 'actions';

    private PyzAntelopeLocationQuery $query;

    public function __construct(PyzAntelopeLocationQuery $query)
    {
        $this->query = $query;
    }

    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config->setHeader([
            static::COL_ID_ANTELOPE_LOCATION => 'ID',
            static::COL_LOCATION_NAME => 'Location Name',
        ]);

        $config->setDefaultSortField(static::COL_ID_ANTELOPE_LOCATION, TableConfiguration::SORT_DESC);

        $config->setSortable([
            static::COL_ID_ANTELOPE_LOCATION,
            static::COL_LOCATION_NAME,
        ]);

        $config->setSearchable([static::COL_LOCATION_NAME]);
        $config->setRawColumns([static::COL_ACTIONS]);

        return $config;
    }

    protected function prepareData(TableConfiguration $config): array
    {
        return $this->runQuery(
            $this->query,
            $config,
        );
    }
}
