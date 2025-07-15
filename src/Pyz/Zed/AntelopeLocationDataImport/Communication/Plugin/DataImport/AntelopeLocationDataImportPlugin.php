<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationDataImport\Communication\Plugin\DataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Pyz\Zed\AntelopeLocationDataImport\AntelopeLocationDataImportConfig;
use Pyz\Zed\AntelopeLocationDataImport\Business\AntelopeLocationDataImportFacadeInterface;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method AntelopeLocationDataImportFacadeInterface getFacade()
 */
class AntelopeLocationDataImportPlugin extends AbstractPlugin implements
    DataImportPluginInterface
{
    public function import(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null
    ): DataImporterReportTransfer {
        return $this->getFacade()->importAntelopeLocation($dataImporterConfigurationTransfer);
    }

    public function getImportType(): string
    {
        return AntelopeLocationDataImportConfig::IMPORT_TYPE_ANTELOPE_LOCATION;
    }
}
