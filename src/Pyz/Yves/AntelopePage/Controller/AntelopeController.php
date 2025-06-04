<?php

namespace Pyz\Yves\AntelopePage\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Spryker\Yves\Kernel\View\View;
use SprykerShop\Yves\ShopApplication\Controller\AbstractController;

/**
 * @method \Pyz\Yves\AntelopePage\AntelopePageFactory getFactory()
 */
class AntelopeController extends AbstractController
{
    public function getAction(string $name): View
    {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        $antelopeCriteriaTransfer->setName($name);

        $antelopeResponseTransfer = $this->getFactory()
            ->getAntelopeClient()
            ->getAntelope($antelopeCriteriaTransfer);

        return $this->view(
            ['antelope' => $antelopeResponseTransfer->getAntelope()],
            [],
            '@AntelopePage/views/antelope/get.twig'
        );
    }

    public function indexAction(): View
    {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();

        $antelopeResponseTransfer = $this->getFactory()
            ->getAntelopeClient()
            ->getAntelopes($antelopeCriteriaTransfer);

        return $this->view(
            ['antelopes' => $antelopeResponseTransfer->getAntelopes()],
            [],
            '@AntelopePage/views/antelope/index.twig'
        );
    }
}
