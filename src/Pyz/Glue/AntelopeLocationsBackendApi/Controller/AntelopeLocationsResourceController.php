<?php declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationsBackendApi\Controller;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Spryker\Glue\Kernel\Backend\Controller\AbstractController;

/**
 * @method \Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiFactory getFactory()
 */
class AntelopeLocationsResourceController extends AbstractController
{
    public function getCollectionAction(GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocationCollection($glueRequestTransfer);
    }

    public function getAction(GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocation($glueRequestTransfer);
    }

    public function postAction(
        AntelopeLocationsBackendApiAttributesTransfer $antelopesLocationBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        return $this->getFactory()->createAntelopeLocationWriter()->createAntelopeLocation($antelopesLocationBackendApiAttributesTransfer,
            $glueRequestTransfer);
    }

    public function putAction(
        AntelopeLocationsBackendApiAttributesTransfer $antelopesLocationBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        $antelopesLocationBackendApiAttributesTransfer->setIdAntelopeLocation((int)$glueRequestTransfer->getResource()?->getId());
        return $this->getFactory()->createAntelopeLocationUpdater()->updateAntelopeLocation($antelopesLocationBackendApiAttributesTransfer,
            $glueRequestTransfer);
    }

    public function deleteAction(GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        return $this->getFactory()->createAntelopeLocationDeleter()->deleteAntelopeLocation($glueRequestTransfer);
    }
}
