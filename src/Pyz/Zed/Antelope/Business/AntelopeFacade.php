<?php

namespace Pyz\Zed\Antelope\Business;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method  \Pyz\Zed\Antelope\Business\AntelopeBusinessFactory getFactory()
 */
class AntelopeFacade extends AbstractFacade implements AntelopeFacadeInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer
    {
        return $this->getFactory()->createAntelopeWriter()->createAntelope($antelopeTransfer);
    }

    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeResponseTransfer
    {
        return $this->getFactory()->createAntelopeReader()->getAntelope($antelopeCriteriaTransfer);
    }

    public function getAntelopeLocationById(int $idLocation): ?AntelopeLocationResponseTransfer
    {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocationById($idLocation);
    }

    public function createAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer
    {
        return $this->getFactory()->createAntelopeLocationWriter()->createAntelopeLocation($antelopeLocationTransfer);
    }
}
