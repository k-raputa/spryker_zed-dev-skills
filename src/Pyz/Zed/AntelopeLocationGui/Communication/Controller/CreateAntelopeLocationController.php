<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationGui\Communication\Controller;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\AntelopeLocationGui\Communication\AntelopeLocationGuiCommunicationFactory;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method AntelopeLocationGuiCommunicationFactory getFactory()
 */
class CreateAntelopeLocationController extends AbstractController
{
    protected const string URL_ANTELOPE_LOCATION_OVERVIEW = '/antelope-location-gui';

    protected const string MESSAGE_ANTELOPE_LOCATION_CREATED_SUCCESS = 'Antelope location was successfully created.';

    /**
     * @param Request $request
     * @return RedirectResponse|array<string,mixed>
     */
    public function indexAction(Request $request): RedirectResponse|array
    {
        $antelopeLocationCreateForm = $this->getFactory()
            ->createAntelopeLocationCreateForm(new AntelopeLocationTransfer())
            ->handleRequest($request);

        if ($antelopeLocationCreateForm->isSubmitted() && $antelopeLocationCreateForm->isValid()) {
            return $this->createAntelopeLocation($antelopeLocationCreateForm);
        }

        return $this->viewResponse([
            'antelopeLocationCreateForm' => $antelopeLocationCreateForm->createView(),
            'backUrl' => $this->getAntelopeLocationOverviewUrl(),
        ]);
    }

    protected function createAntelopeLocation(FormInterface $antelopeLocationCreateForm
    ): RedirectResponse {
        /** @var AntelopeLocationTransfer|null $antelopeLocationTransfer */
        $antelopeLocationTransfer = $antelopeLocationCreateForm->getData();

        $this->getFactory()
            ->getAntelopeFacade()
            ->createAntelopeLocation($antelopeLocationTransfer);

        $this->addSuccessMessage(static::MESSAGE_ANTELOPE_LOCATION_CREATED_SUCCESS);

        return $this->redirectResponse($this->getAntelopeLocationOverviewUrl());
    }

    protected function getAntelopeLocationOverviewUrl(): string
    {
        return (string)Url::generate(static::URL_ANTELOPE_LOCATION_OVERVIEW);
    }
}
