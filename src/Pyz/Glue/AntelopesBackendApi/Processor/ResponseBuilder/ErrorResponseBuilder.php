<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder;

use ArrayObject;
use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\GlueErrorTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Spryker\Glue\ServicePointsBackendApi\ServicePointsBackendApiConfig;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponseBuilder implements ErrorResponseBuilderInterface
{
    /**
     * @var string
     */
    protected const string DEFAULT_LOCALE_NAME = 'en_US';

    public function __construct()
    {
    }

    /**
     * @param string $errorMessage
     * @param string|null $localeName
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function createErrorResponseFromErrorMessage(
        string $errorMessage,
        ?string $localeName = null,
    ): GlueResponseTransfer {
        /** @var array<\Generated\Shared\Transfer\ErrorTransfer> $errorTransfers */
        $errorTransfers = [(new ErrorTransfer())->setMessage($errorMessage)];

        return $this->createErrorResponse(
            new ArrayObject($errorTransfers),
            $localeName,
        );
    }

    /**
     * @param \ArrayObject<int, \Generated\Shared\Transfer\ErrorTransfer> $errorTransfers
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function createErrorResponse(
        ArrayObject $errorTransfers,
    ): GlueResponseTransfer {
        $glueResponseTransfer = new GlueResponseTransfer();

        foreach ($errorTransfers as $errorTransfer) {
            $glueErrorTransfer = $this->createGlueErrorTransfer(
                $errorTransfer,
                $errorTransfer->getMessageOrFail(),
            );

            $glueResponseTransfer->addError($glueErrorTransfer);
        }

        return $this->setGlueResponseHttpStatus($glueResponseTransfer);
    }

    /**
     * @param \ArrayObject $errors
     * @param string $message
     *
     * @return \Generated\Shared\Transfer\GlueErrorTransfer
     */
    protected function createGlueErrorTransfer(
        ErrorTransfer $errorTransfer,
        string $message,
        string $status = Response::HTTP_BAD_REQUEST,
    ): GlueErrorTransfer {
        return (new GlueErrorTransfer())->setStatus($status)
            ->setMessage($message)
            ->fromArray($errorTransfer->getParameters());
    }

    /**
     * @param \Generated\Shared\Transfer\GlueResponseTransfer $glueResponseTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    protected function setGlueResponseHttpStatus(GlueResponseTransfer $glueResponseTransfer): GlueResponseTransfer
    {
        $glueErrorTransfers = $glueResponseTransfer->getErrors();

        if ($glueErrorTransfers->count() !== 1) {
            return $glueResponseTransfer->setHttpStatus(
                Response::HTTP_MULTI_STATUS,
            );
        }

        $glueErrorTransfer = $glueErrorTransfers->getIterator()->current();

        return $glueResponseTransfer->setHttpStatus(
            $glueErrorTransfer->getStatus(),
        );
    }

    /**
     * @param string $message
     *
     * @return \Generated\Shared\Transfer\GlueErrorTransfer
     */
    protected function createUnknownGlueErrorTransfer(string $message): GlueErrorTransfer
    {
        return (new GlueErrorTransfer())
            ->setMessage($message)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setCode(ServicePointsBackendApiConfig::RESPONSE_CODE_UNKNOWN_ERROR);
    }
}
