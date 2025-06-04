<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocation;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeEntityManager extends AbstractEntityManager implements
    AntelopeEntityManagerInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        $antelopeEntity = new PyzAntelope();
        $antelopeEntity->fromArray($antelopeTransfer->modifiedToArray());
        $antelopeEntity->save();

        return $antelopeTransfer->fromArray($antelopeEntity->toArray(), true);
    }

    public function createAntelopeLocation(
        AntelopeLocationTransfer $antelopeLocationTransfer,
    ): AntelopeLocationTransfer {
        $antelopeEntity = new PyzAntelopeLocation();

        $antelopeEntity->fromArray($antelopeLocationTransfer->modifiedToArray());
        $antelopeEntity->save();

        return $antelopeLocationTransfer->fromArray(
            $antelopeEntity->toArray(),
            true,
        );
    }

    public function updateAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        $antelopeEntity = $this->getFactory()->createAntelopeQuery()
            ->filterByIdAntelope($antelopeTransfer->getIdAntelope())->findOne();
        if (!$antelopeEntity) {
            return $antelopeTransfer;
        }
        $mapper = $this->getFactory()->createAntelopeMapper();
        $antelopeEntity = $mapper->mapAntelopeTransferToEntity(
            $antelopeTransfer,
            $antelopeEntity,
        );
        $antelopeEntity->save();

        return $mapper->mapEntityToAntelopeTransfer(
            $antelopeEntity,
            $antelopeTransfer,
        );
    }

    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): int
    {
        return $this->getFactory()->createAntelopeQuery()->filterByPrimaryKey(
            $antelopeTransfer->getIdAntelope(),
        )->delete();
    }

    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): int
    {
        return $this->getFactory()->createAntelopeLocationQuery()->filterByPrimaryKey(
            $antelopeLocationTransfer->getIdAntelopeLocation(),
        )->delete();
    }

    public function updateAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer
    {
        $pyzAntelopeLocationEntity = $this->getFactory()->createAntelopeLocationQuery()->filterByIdAntelopeLocation(
            $antelopeLocationTransfer->getIdAntelopeLocation(),
        )->findOne();

        $pyzAntelopeLocationEntity = $this->getFactory()->createAntelopeLocationMapper(
        )->mapAntelopeLocationTransferToEntity(
            $antelopeLocationTransfer,
            $pyzAntelopeLocationEntity,
        );
        $pyzAntelopeLocationEntity->save();
        return $this->getFactory()->createAntelopeLocationMapper()->mapAntelopeLocationEntityToTransfer(
            $pyzAntelopeLocationEntity,
            $antelopeLocationTransfer,
        );
    }
}
