<?php

declare(strict_types=1);

namespace Stagehand\Services;

use Stagehand\Client;
use Stagehand\Core\Contracts\BaseResponse;
use Stagehand\Core\Exceptions\APIException;
use Stagehand\Core\Util;
use Stagehand\RequestOptions;
use Stagehand\ServiceContracts\SessionsRawContract;
use Stagehand\Sessions\SessionActParams;
use Stagehand\Sessions\SessionEndParams;
use Stagehand\Sessions\SessionExecuteAgentParams;
use Stagehand\Sessions\SessionExtractParams;
use Stagehand\Sessions\SessionNavigateParams;
use Stagehand\Sessions\SessionObserveParams;
use Stagehand\Sessions\SessionStartParams;

final class SessionsRawService implements SessionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Executes a browser action using natural language instructions or a predefined Action object.
     *
     * @param mixed $id Path param: Unique session identifier
     * @param array{
     *   body?: mixed,
     *   xLanguage?: mixed,
     *   xSDKVersion?: mixed,
     *   xSentAt?: mixed,
     *   xStreamResponse?: mixed,
     * }|SessionActParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function act(
        mixed $id,
        array|SessionActParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionActParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['sessions/%1$s/act', $id],
            headers: Util::array_transform_keys(
                array_diff_key($parsed, array_flip(['body'])),
                [
                    'xLanguage' => 'x-language',
                    'xSDKVersion' => 'x-sdk-version',
                    'xSentAt' => 'x-sent-at',
                    'xStreamResponse' => 'x-stream-response',
                ],
            ),
            body: $parsed['body'],
            options: $options,
            convert: 'mixed',
        );
    }

    /**
     * @api
     *
     * Terminates the browser session and releases all associated resources.
     *
     * @param mixed $id Unique session identifier
     * @param array{
     *   xLanguage?: mixed,
     *   xSDKVersion?: mixed,
     *   xSentAt?: mixed,
     *   xStreamResponse?: mixed,
     * }|SessionEndParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function end(
        mixed $id,
        array|SessionEndParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionEndParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['sessions/%1$s/end', $id],
            headers: Util::array_transform_keys(
                $parsed,
                [
                    'xLanguage' => 'x-language',
                    'xSDKVersion' => 'x-sdk-version',
                    'xSentAt' => 'x-sent-at',
                    'xStreamResponse' => 'x-stream-response',
                ],
            ),
            options: $options,
            convert: 'mixed',
        );
    }

    /**
     * @api
     *
     * Runs an autonomous AI agent that can perform complex multi-step browser tasks.
     *
     * @param mixed $id Path param: Unique session identifier
     * @param array{
     *   body?: mixed,
     *   xLanguage?: mixed,
     *   xSDKVersion?: mixed,
     *   xSentAt?: mixed,
     *   xStreamResponse?: mixed,
     * }|SessionExecuteAgentParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function executeAgent(
        mixed $id,
        array|SessionExecuteAgentParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionExecuteAgentParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['sessions/%1$s/agentExecute', $id],
            headers: Util::array_transform_keys(
                array_diff_key($parsed, array_flip(['body'])),
                [
                    'xLanguage' => 'x-language',
                    'xSDKVersion' => 'x-sdk-version',
                    'xSentAt' => 'x-sent-at',
                    'xStreamResponse' => 'x-stream-response',
                ],
            ),
            body: $parsed['body'],
            options: $options,
            convert: 'mixed',
        );
    }

    /**
     * @api
     *
     * Extracts structured data from the current page using AI-powered analysis.
     *
     * @param mixed $id Path param: Unique session identifier
     * @param array{
     *   body?: mixed,
     *   xLanguage?: mixed,
     *   xSDKVersion?: mixed,
     *   xSentAt?: mixed,
     *   xStreamResponse?: mixed,
     * }|SessionExtractParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function extract(
        mixed $id,
        array|SessionExtractParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionExtractParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['sessions/%1$s/extract', $id],
            headers: Util::array_transform_keys(
                array_diff_key($parsed, array_flip(['body'])),
                [
                    'xLanguage' => 'x-language',
                    'xSDKVersion' => 'x-sdk-version',
                    'xSentAt' => 'x-sent-at',
                    'xStreamResponse' => 'x-stream-response',
                ],
            ),
            body: $parsed['body'],
            options: $options,
            convert: 'mixed',
        );
    }

    /**
     * @api
     *
     * Navigates the browser to the specified URL.
     *
     * @param mixed $id Path param: Unique session identifier
     * @param array{
     *   body?: mixed,
     *   xLanguage?: mixed,
     *   xSDKVersion?: mixed,
     *   xSentAt?: mixed,
     *   xStreamResponse?: mixed,
     * }|SessionNavigateParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function navigate(
        mixed $id,
        array|SessionNavigateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionNavigateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['sessions/%1$s/navigate', $id],
            headers: Util::array_transform_keys(
                array_diff_key($parsed, array_flip(['body'])),
                [
                    'xLanguage' => 'x-language',
                    'xSDKVersion' => 'x-sdk-version',
                    'xSentAt' => 'x-sent-at',
                    'xStreamResponse' => 'x-stream-response',
                ],
            ),
            body: $parsed['body'],
            options: $options,
            convert: 'mixed',
        );
    }

    /**
     * @api
     *
     * Identifies and returns available actions on the current page that match the given instruction.
     *
     * @param mixed $id Path param: Unique session identifier
     * @param array{
     *   body?: mixed,
     *   xLanguage?: mixed,
     *   xSDKVersion?: mixed,
     *   xSentAt?: mixed,
     *   xStreamResponse?: mixed,
     * }|SessionObserveParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function observe(
        mixed $id,
        array|SessionObserveParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionObserveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['sessions/%1$s/observe', $id],
            headers: Util::array_transform_keys(
                array_diff_key($parsed, array_flip(['body'])),
                [
                    'xLanguage' => 'x-language',
                    'xSDKVersion' => 'x-sdk-version',
                    'xSentAt' => 'x-sent-at',
                    'xStreamResponse' => 'x-stream-response',
                ],
            ),
            body: $parsed['body'],
            options: $options,
            convert: 'mixed',
        );
    }

    /**
     * @api
     *
     * Creates a new browser session with the specified configuration. Returns a session ID used for all subsequent operations.
     *
     * @param array{
     *   body?: mixed,
     *   xLanguage?: mixed,
     *   xSDKVersion?: mixed,
     *   xSentAt?: mixed,
     *   xStreamResponse?: mixed,
     * }|SessionStartParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function start(
        array|SessionStartParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = SessionStartParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'sessions/start',
            headers: Util::array_transform_keys(
                array_diff_key($parsed, array_flip(['body'])),
                [
                    'xLanguage' => 'x-language',
                    'xSDKVersion' => 'x-sdk-version',
                    'xSentAt' => 'x-sent-at',
                    'xStreamResponse' => 'x-stream-response',
                ],
            ),
            body: $parsed['body'],
            options: $options,
            convert: 'mixed',
        );
    }
}
