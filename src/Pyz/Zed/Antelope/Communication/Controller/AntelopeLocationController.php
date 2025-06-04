<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Communication\Controller;

use Faker\Factory as FakerFactory;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeFacadeInterface getFacade()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 */
class AntelopeLocationController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array<string, mixed>
     */
    public function addAction(Request $request): array
    {
        $antelopeLocationTransfer = new AntelopeLocationTransfer();
        $locationName = $request->get('locationName');
        if (!$locationName) {
            $locationName = FakerFactory::create()->city();
        }
        $antelopeLocationTransfer->setLocationName($locationName);
        $this->getFacade()->createAntelopeLocation($antelopeLocationTransfer);

        return $this->viewResponse(['location' => $antelopeLocationTransfer]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array<string,
     */
    public function getAntelopeLocationAction(Request $request): array
    {
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
        if ($request->query->has('id')) {
            $antelopeLocationCriteriaTransfer->setIdAntelopeLocation($this->castId($request->query->get('id')));
        }
        if ($request->query->has('name')) {
            $antelopeLocationCriteriaTransfer->setLocationName($request->query->get('name'));
        }

        return $this->viewResponse(
            [
                'location' => $this->getFacade()->getAntelopeLocation(
                    $antelopeLocationCriteriaTransfer,
                )->getAntelopeLocation(),
            ],
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array<string,AntelopeLocationTransfer[]
     */
    public function indexAction(Request $request): array
    {
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
        if ($request->query->has('id')) {
            $antelopeLocationCriteriaTransfer->setIdAntelopeLocation($this->castId($request->query->get('id')));
        }
        if ($request->query->has('name')) {
            $antelopeLocationCriteriaTransfer->setLocationName($request->query->get('name'));
        }
        $locations = $this->getFacade()->getAntelopeLocationCollection($antelopeLocationCriteriaTransfer);

        return $this->viewResponse(
            ['antelopes' => $locations->getAntelopeLocations()],
        );
    }
}
