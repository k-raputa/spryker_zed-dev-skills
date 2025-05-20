<?php

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Communication\Controller;

use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\Exception\EntityNotFoundException;
use Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method AntelopeGuiCommunicationFactory getFactory()
 */
class AntelopeLocationController extends AbstractController
{
    public function addAction(Request $request): array
    {
        $antelopeLocationTransfer = new AntelopeLocationTransfer();
        $name = $request->get('location_name') ?: 'default';
        $antelopeLocationTransfer->setLocationName($name);
        $antelopeLocationTransfer = $this->getFacade()->createAntelopeLocation($antelopeLocationTransfer);

        return $this->viewResponse([
            'antelopeLocation' => $antelopeLocationTransfer,
        ]);
    }

    public function getAction(Request $request): array
    {
        if (!$request->query->has('id') && !$request->query->has('location_name')) {
            throw new EntityNotFoundException("Antelope location cannot be found without id or name");
        }

        if ($request->query->has('id')) {
            $antelopeLocationId = $this->castId($request->get('id'));
            $antelopeLocation = $this->getFacade()->getAntelopeLocationById($antelopeLocationId);
        }

        if ($request->query->has('location_name')) {
            $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
            $antelopeLocationCriteriaTransfer->setLocationName($request->query->get('location_name'));
            $antelopeLocation = $this->getFacade()->getAntelopeLocation($antelopeLocationCriteriaTransfer);
        }

        return $this->viewResponse([
            'antelopeLocation' => $antelopeLocation->getAntelopeLocation(),
        ]);
    }

    public function indexAction(Request $request): array
    {
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
        if ($request->query->has('id')) {
            $antelopeLocationCriteriaTransfer->setIdAntelopeLocation($this->castId($request->query->get('id')));
        }
        if ($request->query->has('location_name')) {
            $antelopeLocationCriteriaTransfer->setLocationName($request->query->get('location_name'));
        }
        $locations = $this->getFacade()->getAntelopeLocationCollection($antelopeLocationCriteriaTransfer);

        return $this->viewResponse([
            'antelopeLocations' => $locations->getAntelopeLocations(),
        ]);
    }
}
