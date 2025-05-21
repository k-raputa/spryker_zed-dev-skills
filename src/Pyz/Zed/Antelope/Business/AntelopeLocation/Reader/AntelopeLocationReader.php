<?php

namespace Pyz\Zed\Antelope\Business\AntelopeLocation\Reader;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepository;
use Pyz\Zed\Antelope\Persistence\Exception\EntityNotFoundException;

class AntelopeLocationReader
{
    public function __construct(
        protected AntelopeRepository $antelopeRepository
    )
    {
    }


    /**
     * @throws EntityNotFoundException
     */
    public function getAntelopeLocationById(
        int $idLocation
    ): AntelopeLocationResponseTransfer
    {
        try {
            $antelopeLocationTransfer = $this->antelopeRepository->getAntelopeLocationById($idLocation);
            $antelopeLocationResponseTransfer = new AntelopeLocationResponseTransfer();
            $antelopeLocationResponseTransfer->setAntelopeLocation($antelopeLocationTransfer);
            $antelopeLocationResponseTransfer->setIsSuccessFul(true);

            return $antelopeLocationResponseTransfer;
        } catch (EntityNotFoundException $exception) {
            throw new EntityNotFoundException(
                sprintf('Antelope Location %d not found', $idLocation),
                $exception->getCode(),
                $exception
            );
        }
    }

    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    )
    {
        $antelopeLocationTransfer = $this->antelopeRepository->getAntelopeLocation($antelopeLocationCriteriaTransfer);

        $antelopeLocationResponseTransfer = new AntelopeLocationResponseTransfer();
        $antelopeLocationResponseTransfer->setAntelopeLocation($antelopeLocationTransfer);
        $antelopeLocationResponseTransfer->setIsSuccessFul(true);
        return $antelopeLocationResponseTransfer;
    }

    public function getAntelopeLocations(): AntelopeLocationCollectionTransfer
    {
        return $this->antelopeRepository->getAntelopeLocationCollection();
    }

    public function getAntelopeLocationCollection(AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): AntelopeLocationCollectionTransfer
    {
        return $this->antelopeRepository->getAntelopeLocationCollection($antelopeLocationCriteriaTransfer);
    }
}
