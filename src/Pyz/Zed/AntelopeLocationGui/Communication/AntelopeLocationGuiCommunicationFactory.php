<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationGui\Communication;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\AntelopeLocationGui\AntelopeLocationGuiDependencyProvider;
use Pyz\Zed\AntelopeLocationGui\Communication\Form\AntelopeLocationCreateForm;
use Pyz\Zed\AntelopeLocationGui\Communication\Table\AntelopeLocationTable;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\Form\FormInterface;

/**
 * @method \Pyz\Zed\AntelopeLocationGui\AntelopeLocationGuiConfig getConfig()
 */
class AntelopeLocationGuiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * Creates the AntelopeLocationTable instance.
     *
     * @return \Pyz\Zed\AntelopeLocationGui\Communication\Table\AntelopeLocationTable
     */
    public function createAntelopeLocationTable(): AntelopeLocationTable
    {
        return new AntelopeLocationTable($this->getAntelopeLocationQuery());
    }

    public function getAntelopeLocationQuery(): PyzAntelopeLocationQuery
    {
        return $this->getProvidedDependency(AntelopeLocationGuiDependencyProvider::QUERY_ANTELOPE_LOCATION);
    }

    /**
     * Creates the AntelopeLocationCreateForm instance.
     *
     * @param \Generated\Shared\Transfer\AntelopeLocationTransfer|null $antelopeLocationTransfer
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createAntelopeLocationForm(?AntelopeLocationTransfer $antelopeLocationTransfer = null): FormInterface
    {
        return $this->getFormFactory()->create(AntelopeLocationCreateForm::class, $antelopeLocationTransfer);
    }

    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeLocationGuiDependencyProvider::FACADE_ANTELOPE);
    }
}
