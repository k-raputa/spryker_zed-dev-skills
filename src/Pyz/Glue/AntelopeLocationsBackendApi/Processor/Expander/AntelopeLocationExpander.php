<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Expander;

use Generated\Shared\Transfer\AntelopeConditionTransfer;
use Generated\Shared\Transfer\AntelopeLocationConditionTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Pyz\Glue\AntelopesBackendApi\AntelopeLocationsBackendApiConfig;

class AntelopeLocationExpander implements AntelopeLocationExpanderInterface
{
    public function expandWithFilters(
        AntelopeLocationConditionTransfer $antelopeLocationConditionTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): AntelopeLocationConditionTransfer {
        foreach ($glueRequestTransfer->getFilters() as $filter) {
            if ($filter->getResource() !== AntelopeLocationsBackendApiConfig::RESOURCE_ANTELOPES) {
                return $antelopeLocationConditionTransfer;
            }
            $filterField = $filter->getField();
            $filterValue = $filter->getValue();
            if (!$filterValue) {
                continue;
            }
            switch ($filterField) {
                case AntelopeConditionTransfer::NAME:
                    $antelopeLocationConditionTransfer->setName($filterValue);

                    break;
                case AntelopeLocationConditionTransfer::ANTELOPE_LOCATIONS_IDS:
                    $ids = $this->getIds($filterValue);
                    $antelopeLocationConditionTransfer->setAntelopeLocationsIds($ids);

                    break;
                case AntelopeLocationConditionTransfer::ID_ANTELOPE_LOCATION:
                    $antelopeLocationConditionTransfer->setIdAntelopeLocation((int)$filterValue);

                    break;
            }
        }

        return $antelopeLocationConditionTransfer;
    }

    /**
     * @param array<string>|string $filterValue
     *
     * @return array<int>
     */
    private function getIds(string|array $filterValue): array
    {
        if (is_string($filterValue)) {
            $filterValue = explode(',', $filterValue);
        }

        return array_map(
            'intval',
            array_filter(
                $filterValue,
                static fn (string $item) => is_numeric(trim($item)),
            ),
        );
    }
}
