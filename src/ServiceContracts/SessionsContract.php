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
     * @param mixed $id Path param: Unique session identifier
     * @param mixed $body Body param:
     * @param mixed $xLanguage Header param: Client SDK language
     * @param mixed $xSDKVersion Header param: Version of the Stagehand SDK
     * @param mixed $xSentAt Header param: ISO timestamp when request was sent
     * @param mixed $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @throws APIException
     */
    public function act(
        mixed $id,
        mixed $body = null,
        mixed $xLanguage = null,
        mixed $xSDKVersion = null,
        mixed $xSentAt = null,
        mixed $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param mixed $id Unique session identifier
     * @param mixed $xLanguage Client SDK language
     * @param mixed $xSDKVersion Version of the Stagehand SDK
     * @param mixed $xSentAt ISO timestamp when request was sent
     * @param mixed $xStreamResponse Whether to stream the response via SSE
     *
     * @throws APIException
     */
    public function end(
        mixed $id,
        mixed $xLanguage = null,
        mixed $xSDKVersion = null,
        mixed $xSentAt = null,
        mixed $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param mixed $id Path param: Unique session identifier
     * @param mixed $body Body param:
     * @param mixed $xLanguage Header param: Client SDK language
     * @param mixed $xSDKVersion Header param: Version of the Stagehand SDK
     * @param mixed $xSentAt Header param: ISO timestamp when request was sent
     * @param mixed $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @throws APIException
     */
    public function executeAgent(
        mixed $id,
        mixed $body = null,
        mixed $xLanguage = null,
        mixed $xSDKVersion = null,
        mixed $xSentAt = null,
        mixed $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param mixed $id Path param: Unique session identifier
     * @param mixed $body Body param:
     * @param mixed $xLanguage Header param: Client SDK language
     * @param mixed $xSDKVersion Header param: Version of the Stagehand SDK
     * @param mixed $xSentAt Header param: ISO timestamp when request was sent
     * @param mixed $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @throws APIException
     */
    public function extract(
        mixed $id,
        mixed $body = null,
        mixed $xLanguage = null,
        mixed $xSDKVersion = null,
        mixed $xSentAt = null,
        mixed $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param mixed $id Path param: Unique session identifier
     * @param mixed $body Body param:
     * @param mixed $xLanguage Header param: Client SDK language
     * @param mixed $xSDKVersion Header param: Version of the Stagehand SDK
     * @param mixed $xSentAt Header param: ISO timestamp when request was sent
     * @param mixed $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @throws APIException
     */
    public function navigate(
        mixed $id,
        mixed $body = null,
        mixed $xLanguage = null,
        mixed $xSDKVersion = null,
        mixed $xSentAt = null,
        mixed $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param mixed $id Path param: Unique session identifier
     * @param mixed $body Body param:
     * @param mixed $xLanguage Header param: Client SDK language
     * @param mixed $xSDKVersion Header param: Version of the Stagehand SDK
     * @param mixed $xSentAt Header param: ISO timestamp when request was sent
     * @param mixed $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @throws APIException
     */
    public function observe(
        mixed $id,
        mixed $body = null,
        mixed $xLanguage = null,
        mixed $xSDKVersion = null,
        mixed $xSentAt = null,
        mixed $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;

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
