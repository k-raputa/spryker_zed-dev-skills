<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method AntelopeLocationDataImportBusinessFactory getFactory()
 */
class AntelopeLocationDataImportFacade extends AbstractFacade implements
    AntelopeLocationDataImportFacadeInterface
{
    public function importAntelopeLocation(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null
    ): DataImporterReportTransfer {
        return $this->getFactory()
            ->createAntelopeLocationDataImport($dataImporterConfigurationTransfer)
            ->import($dataImporterConfigurationTransfer);
    }
}
