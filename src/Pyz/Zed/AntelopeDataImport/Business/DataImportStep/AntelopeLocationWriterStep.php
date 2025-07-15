<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeDataImport\Business\DataImportStep;

use Pyz\Zed\AntelopeDataImport\Business\DataSet\AntelopeLocationDataSetInterface;
use Pyz\Zed\AntelopeDataImport\Business\Service\LocationService;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AntelopeLocationWriterStep implements DataImportStepInterface
{

    public function __construct(
        protected LocationService $locationService

    ) {
    }

    public function execute(DataSetInterface $dataSet): void
    {
        if (empty($dataSet[AntelopeLocationDataSetInterface::COLUMN_ID_LOCATION])) {
            $dataSet[AntelopeLocationDataSetInterface::COLUMN_ID_LOCATION] = $this->locationService->getOrCreateDefaultLocationId();
        }
    }
}
