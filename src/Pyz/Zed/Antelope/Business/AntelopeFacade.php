<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Business;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeBusinessFactory getFactory()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 */
class AntelopeFacade extends AbstractFacade implements AntelopeFacadeInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        return $this->getFactory()->createAntelopeWriter()->createAntelope($antelopeTransfer);
    }

    public function getAntelopeLocationById(
        int $idLocation,
    ): ?AntelopeLocationTransfer {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocationById($idLocation);
    }

    public function getAntelope(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer,
    ): AntelopeResponseTransfer {
        return $this->getFactory()->createAntelopeReader()->getAntelope($antelopeCriteriaTransfer);
    }

    public function createAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer {
        return $this->getFactory()->createAntelopeLocationWriter()->createAntelopeLocation($antelopeLocationTransfer);
    }

    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteria,
    ): AntelopeLocationResponseTransfer {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocation($antelopeLocationCriteria);
    }

    public function getAntelopeLocationCollection(AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): AntelopeLocationCollectionTransfer {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocationCollection(
            $antelopeLocationCriteriaTransfer,
        );
    }

    public function getAntelopeCollection(AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeCollectionTransfer {
        return $this->getFactory()->createAntelopeReader()->getAntelopeCollection($antelopeCriteriaTransfer);
    }

    public function getAntelopeLocations(): AntelopeLocationCollectionTransfer
    {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocations();
    }

    public function updateAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        return $this->getFactory()->createAntelopeUpdater()->updateAntelope($antelopeTransfer);
    }

    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): int
    {
        return $this->getFactory()->createAntelopeDeleter()->deleteAntelope($antelopeTransfer);
    }

    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): int
    {
        // add deleteAntelopeLocation

        return $this->getFactory()->createAntelopeLocationDeleter()->deleteAntelopeLocation($antelopeLocationTransfer);
    }

    public function updateAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer
    {
        return $this->getFactory()->createAntelopeLocationUpdater()->updateAntelopeLocation($antelopeLocationTransfer);
    }
}
