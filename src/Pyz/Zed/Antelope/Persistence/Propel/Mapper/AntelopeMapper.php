<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\Base\PyzAntelope;
use Propel\Runtime\Collection\Collection;

class AntelopeMapper
{
    /**
     * @param \Generated\Shared\Transfer\AntelopeTransfer $antelopeTransfer
     * @param \Orm\Zed\Antelope\Persistence\Base\PyzAntelope $entity
     *
     * @return \Orm\Zed\Antelope\Persistence\Base\PyzAntelope
     */
    public function mapAntelopeTransferToEntity(AntelopeTransfer $antelopeTransfer, PyzAntelope $entity): PyzAntelope
    {
        return $entity->fromArray($antelopeTransfer->toArray());
    }

    /**
     * @param \Propel\Runtime\Collection\Collection $entityCollection
     *
     * @return \Generated\Shared\Transfer\AntelopeCollectionTransfer
     */
    public function mapAntelopeEntityCollectionToAntelopeCollectionTransfer(
        Collection $entityCollection,
    ): AntelopeCollectionTransfer {
        $antelopeCollectionTransfer = new AntelopeCollectionTransfer();
        foreach ($entityCollection as $entity) {
            $antelopeTransfer = new AntelopeTransfer();
            $antelopeCollectionTransfer->addAntelope($this->mapEntityToAntelopeTransfer($entity, $antelopeTransfer));
        }

        return $antelopeCollectionTransfer;
    }

    /**
     * @param array $entity
     * @param \Generated\Shared\Transfer\AntelopeTransfer $antelopeTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeTransfer
     */
    public function mapEntityToAntelopeTransfer(
        PyzAntelope $entity,
        AntelopeTransfer $antelopeTransfer,
    ): AntelopeTransfer {
        return $antelopeTransfer->fromArray($entity->toArray(), true);
    }
}
