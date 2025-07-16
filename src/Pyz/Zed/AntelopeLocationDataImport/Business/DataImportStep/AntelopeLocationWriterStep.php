<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationDataImport\Business\DataImportStep;

use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery;
use Pyz\Shared\AntelopeLocationSearch\AntelopeLocationSearchConfig;
use Pyz\Zed\AntelopeLocationDataImport\Business\DataSet\AntelopeLocationDataSetInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;

class AntelopeLocationWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    public function execute(DataSetInterface $dataSet): void
    {
        $antelopeLocationEntity = PyzAntelopeLocationQuery::create()
            ->filterByLocationName($dataSet[AntelopeLocationDataSetInterface::COLUMN_NAME])
            ->findOneOrCreate();
        $antelopeLocationEntity->setLatitude($dataSet[AntelopeLocationDataSetInterface::COLUMN_LATITUDE]);
        $antelopeLocationEntity->setLongitude($dataSet[AntelopeLocationDataSetInterface::COLUMN_LONGITUDE]);

        if ($antelopeLocationEntity->isNew() || $antelopeLocationEntity->isModified()) {
            $antelopeLocationEntity->save();
        }

        $this->addPublishEvents(AntelopeLocationSearchConfig::ANTELOPE_LOCATION_PUBLISH, $antelopeLocationEntity->getIdAntelopeLocation());
    }
}
