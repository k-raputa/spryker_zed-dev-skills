<?php declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Expander;

use Generated\Shared\Transfer\AntelopeConditionTransfer;
use Generated\Shared\Transfer\AntelopeLocationConditionTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiConfig;

class AntelopeLocationExpander implements AntelopeLocationExpanderInterface
{
    public function expandWithFilters(
        AntelopeLocationConditionTransfer $antelopeConditionTransfer,
        GlueRequestTransfer $glueRequestTransfer,
    ): AntelopeLocationConditionTransfer {
        foreach ($glueRequestTransfer->getFilters() as $filter) {
            if ($filter->getResource() !== AntelopeLocationsBackendApiConfig::RESOURCE_ANTELOPE_LOCATIONS) {
                return $antelopeConditionTransfer;
            }
            $filterField = $filter->getField();
            $filterValue = $filter->getValue();
            if (!$filterValue) {
                continue;
            }

            switch ($filterField) {
                case AntelopeLocationConditionTransfer::LOCATION_NAME:
                    $antelopeConditionTransfer->setLocationName($filterValue);

                    break;
                case AntelopeLocationConditionTransfer::ANTELOPE_LOCATIONS_IDS:
                    $ids = $this->getIds($filterValue);
                    $antelopeConditionTransfer->setAntelopeLocationsIds($ids);

                    break;
                case AntelopeLocationConditionTransfer::ID_ANTELOPE_LOCATION:
                    $antelopeConditionTransfer->setIdAntelopeLocation((int)$filterValue);

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
