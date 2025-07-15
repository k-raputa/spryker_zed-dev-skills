<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationDataImport\Business;


use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Pyz\Zed\AntelopeLocationDataImport\Business\DataImportStep\AntelopeLocationWriterStep;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;

class AntelopeLocationDataImportBusinessFactory extends DataImportBusinessFactory
{
    public function createAntelopeLocationDataImport(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null
    ): DataImporterInterface {
        $dataImporter = $this->getCsvDataImporterFromConfig($dataImporterConfigurationTransfer);
        $dataSetStepBroker = $this->createDataSetStepBroker();
        $dataSetStepBroker->addStep($this->createAntelopeLocationWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    private function createAntelopeLocationWriterStep(
    ): AntelopeLocationWriterStep
    {
        return new AntelopeLocationWriterStep();
    }
}
