<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Communication\Controller;

use Faker\Factory as FakerFactory;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeFacadeInterface getFacade()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 */
class IndexController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array<string, mixed>
     */
    public function addAction(Request $request): array
    {
        $antelopeTransfer = new AntelopeTransfer();
        $name = $request->get('name');
        if (!$name) {
            $name = FakerFactory::create()->name();
        }
        $antelopeTransfer->setName($name);
        $this->getFacade()->createAntelope($antelopeTransfer);

        return $this->viewResponse(['antelope' => $antelopeTransfer]);
    }

    public function indexAction(Request $request): array
    {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        if ($request->query->has('id')) {
            $antelopeCriteriaTransfer->setIdAntelope($this->castId($request->query->get('id')));
        }
        if ($request->query->has('name')) {
            $antelopeCriteriaTransfer->setName($request->query->get('name'));
        }
        $antelopes = $this->getFacade()->getAntelopeCollection($antelopeCriteriaTransfer);

        return $this->viewResponse(
            ['antelopes' => $antelopes->getAntelopes()],
        );
    }
}
