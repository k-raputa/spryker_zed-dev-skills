<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Reader;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepository;
use Pyz\Zed\Antelope\Persistence\Exception\EntityNotFoundException;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 */
class AntelopeLocationReader
{
    public function __construct(
        protected AntelopeRepository $antelopeRepository,
    ) {
    }

    /**
     * @throws \Pyz\Zed\Antelope\Persistence\Exception\EntityNotFoundException
     */
    public function getAntelopeLocationById(
        int $idLocation,
    ): AntelopeLocationTransfer {
        try {
            return $this->antelopeRepository->getAntelopeLocationById($idLocation);
        } catch (EntityNotFoundException $exception) {
            throw new EntityNotFoundException(
                sprintf('Antelope Location %d not found', $idLocation),
                $exception->getCode(),
                $exception,
            );
        }
    }

    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteria,
    ): AntelopeLocationResponseTransfer {
        return $this->antelopeRepository->getAntelopeLocation($antelopeLocationCriteria);
    }

    public function getAntelopeLocationCollection(AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer): AntelopeLocationCollectionTransfer
    {
        return $this->antelopeRepository->findAntelopeLocationCollection($antelopeLocationCriteriaTransfer);
    }

    public function getAntelopeLocations(): AntelopeLocationCollectionTransfer
    {
        return $this->antelopeRepository->getAntelopeLocationsCollection();
    }
}
