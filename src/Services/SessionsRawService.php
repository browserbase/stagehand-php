<?php

declare(strict_types=1);

namespace Stagehand\Services;

use Stagehand\Client;
use Stagehand\Core\Contracts\BaseResponse;
use Stagehand\Core\Contracts\BaseStream;
use Stagehand\Core\Exceptions\APIException;
use Stagehand\Core\Util;
use Stagehand\RequestOptions;
use Stagehand\ServiceContracts\SessionsRawContract;
use Stagehand\Sessions\SessionActParams;
use Stagehand\Sessions\SessionActParams\XStreamResponse;
use Stagehand\Sessions\SessionActResponse;
use Stagehand\Sessions\SessionEndParams;
use Stagehand\Sessions\SessionEndResponse;
use Stagehand\Sessions\SessionExecuteParams;
use Stagehand\Sessions\SessionExecuteParams\AgentConfig;
use Stagehand\Sessions\SessionExecuteParams\ExecuteOptions;
use Stagehand\Sessions\SessionExecuteResponse;
use Stagehand\Sessions\SessionExtractParams;
use Stagehand\Sessions\SessionExtractResponse;
use Stagehand\Sessions\SessionNavigateParams;
use Stagehand\Sessions\SessionNavigateParams\Options;
use Stagehand\Sessions\SessionNavigateResponse;
use Stagehand\Sessions\SessionObserveParams;
use Stagehand\Sessions\SessionObserveResponse;
use Stagehand\Sessions\SessionReplayParams;
use Stagehand\Sessions\SessionReplayResponse;
use Stagehand\Sessions\SessionStartParams;
use Stagehand\Sessions\SessionStartParams\Browser;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams;
use Stagehand\Sessions\SessionStartResponse;
use Stagehand\Sessions\StreamEvent;
use Stagehand\SSEStream;

/**
 * @phpstan-import-type OptionsShape from \Stagehand\Sessions\SessionNavigateParams\Options
 * @phpstan-import-type BrowserShape from \Stagehand\Sessions\SessionStartParams\Browser
 * @phpstan-import-type BrowserbaseSessionCreateParamsShape from \Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams
 * @phpstan-import-type InputShape from \Stagehand\Sessions\SessionActParams\Input
 * @phpstan-import-type OptionsShape from \Stagehand\Sessions\SessionActParams\Options as OptionsShape1
 * @phpstan-import-type RequestOpts from \Stagehand\RequestOptions
 * @phpstan-import-type AgentConfigShape from \Stagehand\Sessions\SessionExecuteParams\AgentConfig
 * @phpstan-import-type ExecuteOptionsShape from \Stagehand\Sessions\SessionExecuteParams\ExecuteOptions
 * @phpstan-import-type OptionsShape from \Stagehand\Sessions\SessionExtractParams\Options as OptionsShape2
 * @phpstan-import-type OptionsShape from \Stagehand\Sessions\SessionObserveParams\Options as OptionsShape3
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
     *   frameID?: string|null,
     *   options?: SessionActParams\Options|OptionsShape1,
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
        $header_params = ['xStreamResponse' => 'x-stream-response'];

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
     *   frameID?: string|null,
     *   options?: SessionActParams\Options|OptionsShape1,
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
        $header_params = ['xStreamResponse' => 'x-stream-response'];

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
     * @param string $id Unique session identifier
     * @param array{
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

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/sessions/%1$s/end', $id],
            headers: Util::array_transform_keys(
                $parsed,
                ['xStreamResponse' => 'x-stream-response']
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
     *   frameID?: string|null,
     *   shouldCache?: bool,
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
        $header_params = ['xStreamResponse' => 'x-stream-response'];

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
     *   frameID?: string|null,
     *   shouldCache?: bool,
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
        $header_params = ['xStreamResponse' => 'x-stream-response'];

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
     *   frameID?: string|null,
     *   instruction?: string,
     *   options?: SessionExtractParams\Options|OptionsShape2,
     *   schema?: array<string,mixed>,
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
        $header_params = ['xStreamResponse' => 'x-stream-response'];

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
     *   frameID?: string|null,
     *   instruction?: string,
     *   options?: SessionExtractParams\Options|OptionsShape2,
     *   schema?: array<string,mixed>,
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
        $header_params = ['xStreamResponse' => 'x-stream-response'];

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
     *   frameID?: string|null,
     *   options?: Options|OptionsShape,
     *   streamResponse?: bool,
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
        $header_params = ['xStreamResponse' => 'x-stream-response'];

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
     *   frameID?: string|null,
     *   instruction?: string,
     *   options?: SessionObserveParams\Options|OptionsShape3,
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
        $header_params = ['xStreamResponse' => 'x-stream-response'];

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
     *   frameID?: string|null,
     *   instruction?: string,
     *   options?: SessionObserveParams\Options|OptionsShape3,
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
        $header_params = ['xStreamResponse' => 'x-stream-response'];

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
     * Retrieves replay metrics for a session.
     *
     * @param string $id Unique session identifier
     * @param array{
     *   xStreamResponse?: SessionReplayParams\XStreamResponse|value-of<SessionReplayParams\XStreamResponse>,
     * }|SessionReplayParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionReplayResponse>
     *
     * @throws APIException
     */
    public function replay(
        string $id,
        array|SessionReplayParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionReplayParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/sessions/%1$s/replay', $id],
            headers: Util::array_transform_keys(
                $parsed,
                ['xStreamResponse' => 'x-stream-response']
            ),
            options: $options,
            convert: SessionReplayResponse::class,
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
        $header_params = ['xStreamResponse' => 'x-stream-response'];

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
