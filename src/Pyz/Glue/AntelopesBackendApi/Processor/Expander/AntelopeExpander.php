<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Glue\AntelopesBackendApi\Processor\Expander;

use Generated\Shared\Transfer\AntelopeConditionTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiConfig;

class AntelopeExpander implements AntelopeExpanderInterface
{
    public function expandWithFilters(
        AntelopeConditionTransfer $antelopeConditionTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): AntelopeConditionTransfer {
        foreach ($glueRequestTransfer->getFilters() as $filter) {
            if ($filter->getResource() !== AntelopesBackendApiConfig::RESOURCE_ANTELOPES) {
                return $antelopeConditionTransfer;
            }
            $filterField = $filter->getField();
            $filterValue = $filter->getValue();
            if (!$filterValue) {
                continue;
            }
            switch ($filterField) {
                case AntelopeConditionTransfer::ID_ANTELOPE:
                    $antelopeConditionTransfer->setIdAntelope((int)$filterValue);

                    break;
                case AntelopeConditionTransfer::NAME:
                    $antelopeConditionTransfer->setName($filterValue);

                    break;
                case AntelopeConditionTransfer::ANTELOPE_IDS:
                    $ids = $this->getIds($filterValue);
                    $antelopeConditionTransfer->setAntelopeIds($ids);

                    break;
            }
        }

        return $antelopeConditionTransfer;
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
