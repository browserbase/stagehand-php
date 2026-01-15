<?php

declare(strict_types=1);

namespace StagehandSDK\Services;

use StagehandSDK\Client;
use StagehandSDK\Core\Contracts\BaseResponse;
use StagehandSDK\Core\Contracts\BaseStream;
use StagehandSDK\Core\Exceptions\APIException;
use StagehandSDK\Core\Util;
use StagehandSDK\RequestOptions;
use StagehandSDK\ServiceContracts\SessionsRawContract;
use StagehandSDK\Sessions\SessionActParams;
use StagehandSDK\Sessions\SessionActParams\XStreamResponse;
use StagehandSDK\Sessions\SessionActResponse;
use StagehandSDK\Sessions\SessionEndParams;
use StagehandSDK\Sessions\SessionEndResponse;
use StagehandSDK\Sessions\SessionExecuteParams;
use StagehandSDK\Sessions\SessionExecuteParams\AgentConfig;
use StagehandSDK\Sessions\SessionExecuteParams\ExecuteOptions;
use StagehandSDK\Sessions\SessionExecuteResponse;
use StagehandSDK\Sessions\SessionExtractParams;
use StagehandSDK\Sessions\SessionExtractResponse;
use StagehandSDK\Sessions\SessionNavigateParams;
use StagehandSDK\Sessions\SessionNavigateParams\Options;
use StagehandSDK\Sessions\SessionNavigateResponse;
use StagehandSDK\Sessions\SessionObserveParams;
use StagehandSDK\Sessions\SessionObserveResponse;
use StagehandSDK\Sessions\SessionStartParams;
use StagehandSDK\Sessions\SessionStartParams\Browser;
use StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams;
use StagehandSDK\Sessions\SessionStartResponse;
use StagehandSDK\Sessions\StreamEvent;
use StagehandSDK\SSEStream;

/**
 * @phpstan-import-type OptionsShape from \StagehandSDK\Sessions\SessionNavigateParams\Options
 * @phpstan-import-type BrowserShape from \StagehandSDK\Sessions\SessionStartParams\Browser
 * @phpstan-import-type BrowserbaseSessionCreateParamsShape from \StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams
 * @phpstan-import-type InputShape from \StagehandSDK\Sessions\SessionActParams\Input
 * @phpstan-import-type OptionsShape from \StagehandSDK\Sessions\SessionActParams\Options as OptionsShape1
 * @phpstan-import-type RequestOpts from \StagehandSDK\RequestOptions
 * @phpstan-import-type AgentConfigShape from \StagehandSDK\Sessions\SessionExecuteParams\AgentConfig
 * @phpstan-import-type ExecuteOptionsShape from \StagehandSDK\Sessions\SessionExecuteParams\ExecuteOptions
 * @phpstan-import-type OptionsShape from \StagehandSDK\Sessions\SessionExtractParams\Options as OptionsShape2
 * @phpstan-import-type OptionsShape from \StagehandSDK\Sessions\SessionObserveParams\Options as OptionsShape3
 */
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
     * @param string $id Path param: Unique session identifier
     * @param array{
     *   input: InputShape,
     *   frameID?: string,
     *   options?: SessionActParams\Options|OptionsShape1,
     *   xSentAt?: \DateTimeInterface,
     *   xStreamResponse?: XStreamResponse|value-of<XStreamResponse>,
     * }|SessionActParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionActResponse>
     *
     * @throws APIException
     */
    public function act(
        string $id,
        array|SessionActParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionActParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'xSentAt' => 'x-sent-at', 'xStreamResponse' => 'x-stream-response',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/sessions/%1$s/act', $id],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: SessionActResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param array{
     *   input: InputShape,
     *   frameID?: string,
     *   options?: SessionActParams\Options|OptionsShape1,
     *   xSentAt?: \DateTimeInterface,
     *   xStreamResponse?: XStreamResponse|value-of<XStreamResponse>,
     * }|SessionActParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseStream<StreamEvent>>
     *
     * @throws APIException
     */
    public function actStream(
        string $id,
        array|SessionActParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionActParams::parseRequest(
            $params,
            $requestOptions,
        );
        $parsed['streamResponse'] = true;
        $header_params = [
            'xSentAt' => 'x-sent-at', 'xStreamResponse' => 'x-stream-response',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/sessions/%1$s/act', $id],
            headers: Util::array_transform_keys(
                [
                    'Accept' => 'text/event-stream',
                    ...array_intersect_key(
                        $parsed,
                        array_flip(array_keys($header_params))
                    ),
                ],
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: StreamEvent::class,
            stream: SSEStream::class,
        );
    }

    /**
     * @api
     *
     * Terminates the browser session and releases all associated resources.
     *
     * @param string $id Path param: Unique session identifier
     * @param array{
     *   _forceBody?: mixed,
     *   xSentAt?: \DateTimeInterface,
     *   xStreamResponse?: SessionEndParams\XStreamResponse|value-of<SessionEndParams\XStreamResponse>,
     * }|SessionEndParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionEndResponse>
     *
     * @throws APIException
     */
    public function end(
        string $id,
        array|SessionEndParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionEndParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'xSentAt' => 'x-sent-at', 'xStreamResponse' => 'x-stream-response',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/sessions/%1$s/end', $id],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: SessionEndResponse::class,
        );
    }

    /**
     * @api
     *
     * Runs an autonomous AI agent that can perform complex multi-step browser tasks.
     *
     * @param string $id Path param: Unique session identifier
     * @param array{
     *   agentConfig: AgentConfig|AgentConfigShape,
     *   executeOptions: ExecuteOptions|ExecuteOptionsShape,
     *   frameID?: string,
     *   xSentAt?: \DateTimeInterface,
     *   xStreamResponse?: SessionExecuteParams\XStreamResponse|value-of<SessionExecuteParams\XStreamResponse>,
     * }|SessionExecuteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionExecuteResponse>
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        array|SessionExecuteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionExecuteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'xSentAt' => 'x-sent-at', 'xStreamResponse' => 'x-stream-response',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/sessions/%1$s/agentExecute', $id],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: SessionExecuteResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param array{
     *   agentConfig: AgentConfig|AgentConfigShape,
     *   executeOptions: ExecuteOptions|ExecuteOptionsShape,
     *   frameID?: string,
     *   xSentAt?: \DateTimeInterface,
     *   xStreamResponse?: SessionExecuteParams\XStreamResponse|value-of<SessionExecuteParams\XStreamResponse>,
     * }|SessionExecuteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseStream<StreamEvent>>
     *
     * @throws APIException
     */
    public function executeStream(
        string $id,
        array|SessionExecuteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionExecuteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $parsed['streamResponse'] = true;
        $header_params = [
            'xSentAt' => 'x-sent-at', 'xStreamResponse' => 'x-stream-response',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/sessions/%1$s/agentExecute', $id],
            headers: Util::array_transform_keys(
                [
                    'Accept' => 'text/event-stream',
                    ...array_intersect_key(
                        $parsed,
                        array_flip(array_keys($header_params))
                    ),
                ],
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: StreamEvent::class,
            stream: SSEStream::class,
        );
    }

    /**
     * @api
     *
     * Extracts structured data from the current page using AI-powered analysis.
     *
     * @param string $id Path param: Unique session identifier
     * @param array{
     *   frameID?: string,
     *   instruction?: string,
     *   options?: SessionExtractParams\Options|OptionsShape2,
     *   schema?: array<string,mixed>,
     *   xSentAt?: \DateTimeInterface,
     *   xStreamResponse?: SessionExtractParams\XStreamResponse|value-of<SessionExtractParams\XStreamResponse>,
     * }|SessionExtractParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionExtractResponse>
     *
     * @throws APIException
     */
    public function extract(
        string $id,
        array|SessionExtractParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionExtractParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'xSentAt' => 'x-sent-at', 'xStreamResponse' => 'x-stream-response',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/sessions/%1$s/extract', $id],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: SessionExtractResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param array{
     *   frameID?: string,
     *   instruction?: string,
     *   options?: SessionExtractParams\Options|OptionsShape2,
     *   schema?: array<string,mixed>,
     *   xSentAt?: \DateTimeInterface,
     *   xStreamResponse?: SessionExtractParams\XStreamResponse|value-of<SessionExtractParams\XStreamResponse>,
     * }|SessionExtractParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseStream<StreamEvent>>
     *
     * @throws APIException
     */
    public function extractStream(
        string $id,
        array|SessionExtractParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionExtractParams::parseRequest(
            $params,
            $requestOptions,
        );
        $parsed['streamResponse'] = true;
        $header_params = [
            'xSentAt' => 'x-sent-at', 'xStreamResponse' => 'x-stream-response',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/sessions/%1$s/extract', $id],
            headers: Util::array_transform_keys(
                [
                    'Accept' => 'text/event-stream',
                    ...array_intersect_key(
                        $parsed,
                        array_flip(array_keys($header_params))
                    ),
                ],
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: StreamEvent::class,
            stream: SSEStream::class,
        );
    }

    /**
     * @api
     *
     * Navigates the browser to the specified URL.
     *
     * @param string $id Path param: Unique session identifier
     * @param array{
     *   url: string,
     *   frameID?: string,
     *   options?: Options|OptionsShape,
     *   streamResponse?: bool,
     *   xSentAt?: \DateTimeInterface,
     *   xStreamResponse?: SessionNavigateParams\XStreamResponse|value-of<SessionNavigateParams\XStreamResponse>,
     * }|SessionNavigateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionNavigateResponse>
     *
     * @throws APIException
     */
    public function navigate(
        string $id,
        array|SessionNavigateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionNavigateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'xSentAt' => 'x-sent-at', 'xStreamResponse' => 'x-stream-response',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/sessions/%1$s/navigate', $id],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: SessionNavigateResponse::class,
        );
    }

    /**
     * @api
     *
     * Identifies and returns available actions on the current page that match the given instruction.
     *
     * @param string $id Path param: Unique session identifier
     * @param array{
     *   frameID?: string,
     *   instruction?: string,
     *   options?: SessionObserveParams\Options|OptionsShape3,
     *   xSentAt?: \DateTimeInterface,
     *   xStreamResponse?: SessionObserveParams\XStreamResponse|value-of<SessionObserveParams\XStreamResponse>,
     * }|SessionObserveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionObserveResponse>
     *
     * @throws APIException
     */
    public function observe(
        string $id,
        array|SessionObserveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionObserveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'xSentAt' => 'x-sent-at', 'xStreamResponse' => 'x-stream-response',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/sessions/%1$s/observe', $id],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: SessionObserveResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param array{
     *   frameID?: string,
     *   instruction?: string,
     *   options?: SessionObserveParams\Options|OptionsShape3,
     *   xSentAt?: \DateTimeInterface,
     *   xStreamResponse?: SessionObserveParams\XStreamResponse|value-of<SessionObserveParams\XStreamResponse>,
     * }|SessionObserveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseStream<StreamEvent>>
     *
     * @throws APIException
     */
    public function observeStream(
        string $id,
        array|SessionObserveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionObserveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $parsed['streamResponse'] = true;
        $header_params = [
            'xSentAt' => 'x-sent-at', 'xStreamResponse' => 'x-stream-response',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/sessions/%1$s/observe', $id],
            headers: Util::array_transform_keys(
                [
                    'Accept' => 'text/event-stream',
                    ...array_intersect_key(
                        $parsed,
                        array_flip(array_keys($header_params))
                    ),
                ],
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: StreamEvent::class,
            stream: SSEStream::class,
        );
    }

    /**
     * @api
     *
     * Creates a new browser session with the specified configuration. Returns a session ID used for all subsequent operations.
     *
     * @param array{
     *   modelName: string,
     *   actTimeoutMs?: float,
     *   browser?: Browser|BrowserShape,
     *   browserbaseSessionCreateParams?: BrowserbaseSessionCreateParams|BrowserbaseSessionCreateParamsShape,
     *   browserbaseSessionID?: string,
     *   domSettleTimeoutMs?: float,
     *   experimental?: bool,
     *   selfHeal?: bool,
     *   systemPrompt?: string,
     *   verbose?: float,
     *   waitForCaptchaSolves?: bool,
     *   xSentAt?: \DateTimeInterface,
     *   xStreamResponse?: SessionStartParams\XStreamResponse|value-of<SessionStartParams\XStreamResponse>,
     * }|SessionStartParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionStartResponse>
     *
     * @throws APIException
     */
    public function start(
        array|SessionStartParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionStartParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'xSentAt' => 'x-sent-at', 'xStreamResponse' => 'x-stream-response',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/sessions/start',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: SessionStartResponse::class,
        );
    }
}
