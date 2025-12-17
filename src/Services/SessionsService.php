<?php

declare(strict_types=1);

namespace Stagehand\Services;

use Stagehand\Client;
use Stagehand\Core\Exceptions\APIException;
use Stagehand\Core\Util;
use Stagehand\RequestOptions;
use Stagehand\ServiceContracts\SessionsContract;

final class SessionsService implements SessionsContract
{
    /**
     * @api
     */
    public SessionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SessionsRawService($client);
    }

    /**
     * @api
     *
     * Executes a browser action using natural language instructions or a predefined Action object.
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'body' => $body,
                'xLanguage' => $xLanguage,
                'xSDKVersion' => $xSDKVersion,
                'xSentAt' => $xSentAt,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->act($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Terminates the browser session and releases all associated resources.
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'xLanguage' => $xLanguage,
                'xSDKVersion' => $xSDKVersion,
                'xSentAt' => $xSentAt,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->end($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Runs an autonomous AI agent that can perform complex multi-step browser tasks.
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'body' => $body,
                'xLanguage' => $xLanguage,
                'xSDKVersion' => $xSDKVersion,
                'xSentAt' => $xSentAt,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->executeAgent($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Extracts structured data from the current page using AI-powered analysis.
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'body' => $body,
                'xLanguage' => $xLanguage,
                'xSDKVersion' => $xSDKVersion,
                'xSentAt' => $xSentAt,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->extract($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Navigates the browser to the specified URL.
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'body' => $body,
                'xLanguage' => $xLanguage,
                'xSDKVersion' => $xSDKVersion,
                'xSentAt' => $xSentAt,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->navigate($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Identifies and returns available actions on the current page that match the given instruction.
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'body' => $body,
                'xLanguage' => $xLanguage,
                'xSDKVersion' => $xSDKVersion,
                'xSentAt' => $xSentAt,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->observe($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Creates a new browser session with the specified configuration. Returns a session ID used for all subsequent operations.
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'body' => $body,
                'xLanguage' => $xLanguage,
                'xSDKVersion' => $xSDKVersion,
                'xSentAt' => $xSentAt,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->start(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
