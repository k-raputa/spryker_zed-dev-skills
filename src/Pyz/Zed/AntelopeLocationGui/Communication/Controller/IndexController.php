<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationGui\Communication\Controller;

use Pyz\Zed\AntelopeLocationGui\Communication\AntelopeLocationGuiCommunicationFactory;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method AntelopeLocationGuiCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    /**
     * @return array<string,mixed>
     */
    public function indexAction(): array
    {
        $table = $this->getFactory()->createAntelopeLocationTable();

        return $this->viewResponse([
            'antelopeLocationTable' => $table->render(),
        ]);
    }

    public function tableAction(): JsonResponse
    {
        $table = $this->getFactory()->createAntelopeLocationTable();

        return $this->jsonResponse($table->fetchData());
    }
}
