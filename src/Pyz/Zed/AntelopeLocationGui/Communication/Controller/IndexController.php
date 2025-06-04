<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationGui\Communication\Controller;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\AntelopeLocationGui\AntelopeLocationGuiConfig;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\AntelopeLocationGui\Communication\AntelopeLocationGuiCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    public const string MESSAGE_CREATE_ERROR = 'Antelope location could not be created';

    public const string MESSAGE_CREATE_SUCCESS = 'Antelope location created successfully';

    public function indexAction(Request $request): array
    {
        $table = $this->getFactory()->createAntelopeLocationTable();
        $tableView = $table->render();

        $form = $this->getFactory()->createAntelopeLocationForm()->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->getFactory()->getAntelopeLocationFacade()->createLocation($data['name']);

            $this->addSuccessMessage('Location created successfully.');

            return $this->redirectResponse('/antelope-location-gui');
        }

        return $this->viewResponse([
            'table' => $tableView,
            'createUrl' => AntelopeLocationGuiConfig::URL_ANTELOPE_LOCATION_CREATE,

        ]);
    }

    public function tableAction(Request $request): JsonResponse
    {
        $table = $this->getFactory()->createAntelopeLocationTable();

        return $this->jsonResponse($table->fetchData());
    }

    public function createAction(Request $request): array|RedirectResponse
    {
        $antelopeLocationForm = $this->getFactory()
            ->createAntelopeLocationForm(new AntelopeLocationTransfer())
            ->handleRequest($request);

        if ($antelopeLocationForm->isSubmitted() && $antelopeLocationForm->isValid()) {
            /** @var \Generated\Shared\Transfer\AntelopeLocationTransfer $antelopeLocationTransfer */
            $antelopeLocationTransfer = $antelopeLocationForm->getData();
            $antelopeLocationTransfer = $this->getFactory()
                ->getAntelopeFacade()
                ->createAntelopeLocation($antelopeLocationTransfer);

            if ($antelopeLocationTransfer->getIdAntelopeLocation()) {
                $this->addSuccessMessage(static::MESSAGE_CREATE_SUCCESS);
            } else {
                $this->addErrorMessage(static::MESSAGE_CREATE_ERROR);
            }

            return $this->redirectResponse(AntelopeLocationGuiConfig::URL_ANTELOPE_LOCATION_LIST);
        }

        return $this->viewResponse([
            'antelopeLocationForm' => $antelopeLocationForm->createView(),
            'backUrl' => AntelopeLocationGuiConfig::URL_ANTELOPE_LOCATION_LIST,
        ]);
    }
}
