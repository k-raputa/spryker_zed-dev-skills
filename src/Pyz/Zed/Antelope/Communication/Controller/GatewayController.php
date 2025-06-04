<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Communication\Controller;

use Faker\Factory as FakerFactory;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeFacadeInterface getFacade()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 */
class GatewayController extends AbstractGatewayController
{
    public function getAntelopeAction(AntelopeCriteriaTransfer $antelopeCriteria): AntelopeResponseTransfer
    {
        return $this->getFacade()
            ->getAntelope($antelopeCriteria);
    }

    public function getAntelopeLocationAction(Request $request): AntelopeLocationResponseTransfer
    {
        $antelopeLocationCriteriaTransfer = (new AntelopeLocationCriteriaTransfer());
        if ($request->query->has('id')) {
            $antelopeLocationCriteriaTransfer->setIdAntelopeLocation($this->castId($request->query->get('id')));
        }
        if ($request->query->has('name')) {
            $antelopeLocationCriteriaTransfer->setLocationName($request->query->get('name'));
        }

        return $this->getFacade()->getAntelopeLocation($antelopeLocationCriteriaTransfer);
    }

    public function addAntelopeAction(Request $request): array
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

    public function addAntelopeLocationAction(Request $request): AntelopeLocationTransfer
    {
        $antelopeLocationTransfer = new AntelopeLocationTransfer();
        $locationName = $request->get('locationName');
        if (!$locationName) {
            $locationName = FakerFactory::create()->city();
        }
        $antelopeLocationTransfer->setLocationName($locationName);

        return $this->getFacade()->createAntelopeLocation($antelopeLocationTransfer);
    }
}
