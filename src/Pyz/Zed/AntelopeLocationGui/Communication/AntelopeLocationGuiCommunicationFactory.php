<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationGui\Communication;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\AntelopeGui\AntelopeGuiDependencyProvider;
use Pyz\Zed\AntelopeLocationGui\AntelopeLocationGuiConfig;
use Pyz\Zed\AntelopeLocationGui\AntelopeLocationGuiDependencyProvider;
use Pyz\Zed\AntelopeLocationGui\Communication\Form\AntelopeLocationCreateForm;
use Pyz\Zed\AntelopeLocationGui\Communication\Table\AntelopeLocationTable;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException;
use Symfony\Component\Form\FormInterface;

/**
 * @method AntelopeLocationGuiConfig getConfig()
 */
class AntelopeLocationGuiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @throws ContainerKeyNotFoundException
     */
    public function createAntelopeLocationTable(): AntelopeLocationTable
    {
        return new AntelopeLocationTable(
            $this->getAntelopeLocationPropelQuery()
        );
    }

    /**
     * @throws ContainerKeyNotFoundException
     */
    public function getAntelopeLocationPropelQuery(): PyzAntelopeLocationQuery
    {
        return $this->getProvidedDependency(AntelopeLocationGuiDependencyProvider::PROPEL_QUERY_ANTELOPE_LOCATION);
    }

    /**
     * @param AntelopeLocationTransfer $antelopeLocationTransfer
     * @param array $options <string,mixed>
     * @return FormInterface
     */
    public function createAntelopeLocationCreateForm(
        AntelopeLocationTransfer $antelopeLocationTransfer,
        array $options = []
    ): FormInterface
    {
        return $this->getFormFactory()->create(
            AntelopeLocationCreateForm::class,
            $antelopeLocationTransfer,
            $options
        );
    }

    /**
     * @throws ContainerKeyNotFoundException
     */
    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeGuiDependencyProvider::FACADE_ANTELOPE);
    }
}
