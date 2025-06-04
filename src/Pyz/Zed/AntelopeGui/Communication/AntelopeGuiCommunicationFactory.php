<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeGui\Communication;

use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\AntelopeGui\AntelopeGuiDependencyProvider;
use Pyz\Zed\AntelopeGui\Communication\Form\AntelopeCreateForm;
use Pyz\Zed\AntelopeGui\Communication\Form\AntelopeDataProvider;
use Pyz\Zed\AntelopeGui\Communication\Table\AntelopeTable;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\Form\FormInterface;

/**
 * @method \Pyz\Zed\AntelopeGui\AntelopeGuiConfig getConfig()
 */
class AntelopeGuiCommunicationFactory extends AbstractCommunicationFactory
{
    public function createAntelopeTable(): AntelopeTable
    {
        return new AntelopeTable(
            $this->getAntelopePropelQuery(),
        );
    }

    public function getAntelopePropelQuery(): PyzAntelopeQuery
    {
        return $this->getProvidedDependency(AntelopeGuiDependencyProvider::PROPEL_QUERY_ANTELOPE);
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $antelopeTransfer
     * @param array $options <string,mixed>
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createAntelopeCreateForm(
        AntelopeTransfer $antelopeTransfer,
        array $options = [],
    ): FormInterface {
        $dataProvider = $this->createAntelopeDataProvider();

        $options = $options ?: $dataProvider->getOptions();

        return $this->getFormFactory()->create(
            AntelopeCreateForm::class,
            $antelopeTransfer,
            $options,
        );
    }

    public function createAntelopeDataProvider(): AntelopeDataProvider
    {
        return new AntelopeDataProvider($this->getAntelopeFacade());
    }

    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeGuiDependencyProvider::FACADE_ANTELOPE);
    }
}
