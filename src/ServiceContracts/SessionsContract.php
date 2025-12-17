<?php

declare(strict_types=1);

namespace Stagehand\ServiceContracts;

use Stagehand\Core\Exceptions\APIException;
use Stagehand\RequestOptions;

interface SessionsContract
{
    /**
     * @api
     *
     * @param mixed $body Body param:
     * @param mixed $xLanguage Header param: Client SDK language
     * @param mixed $xSDKVersion Header param: Version of the Stagehand SDK
     * @param mixed $xSentAt Header param: ISO timestamp when request was sent
     * @param mixed $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @throws APIException
     */
    public function start(
        mixed $body = null,
        mixed $xLanguage = null,
        mixed $xSDKVersion = null,
        mixed $xSentAt = null,
        mixed $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
