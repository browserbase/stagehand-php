<?php

declare(strict_types=1);

namespace Stagehand\Services;

use Stagehand\Client;
use Stagehand\Core\Contracts\BaseResponse;
use Stagehand\Core\Conversion\ListOf;
use Stagehand\Core\Exceptions\APIException;
use Stagehand\Core\Util;
use Stagehand\RequestOptions;
use Stagehand\ServiceContracts\SessionsRawContract;
use Stagehand\Sessions\Action;
use Stagehand\Sessions\SessionActParams;
use Stagehand\Sessions\SessionActParams\XStreamResponse;
use Stagehand\Sessions\SessionActResponse;
use Stagehand\Sessions\SessionEndResponse;
use Stagehand\Sessions\SessionExecuteAgentParams;
use Stagehand\Sessions\SessionExecuteAgentParams\AgentConfig\Provider;
use Stagehand\Sessions\SessionExecuteAgentResponse;
use Stagehand\Sessions\SessionExtractParams;
use Stagehand\Sessions\SessionExtractResponse;
use Stagehand\Sessions\SessionExtractResponse\Extraction;
use Stagehand\Sessions\SessionNavigateParams;
use Stagehand\Sessions\SessionNavigateParams\Options\WaitUntil;
use Stagehand\Sessions\SessionNavigateResponse;
use Stagehand\Sessions\SessionObserveParams;
use Stagehand\Sessions\SessionStartParams;
use Stagehand\Sessions\SessionStartParams\Env;
use Stagehand\Sessions\SessionStartResponse;

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
     * Performs a browser action based on natural language instruction or
     * a specific action object returned by observe().
     *
     * @param string $sessionID Path param: The session ID returned by /sessions/start
     * @param array{
     *   input: string|array{
     *     arguments: list<string>,
     *     description: string,
     *     method: string,
     *     selector: string,
     *     backendNodeID?: int,
     *   }|Action,
     *   frameID?: string,
     *   options?: array{
     *     model?: array{
     *       apiKey?: string,
     *       baseURL?: string,
     *       model?: string,
     *       provider?: 'openai'|'anthropic'|'google'|\Stagehand\Sessions\ModelConfig\Provider,
     *     },
     *     timeout?: int,
     *     variables?: array<string,string>,
     *   },
     *   xStreamResponse?: 'true'|'false'|XStreamResponse,
     * }|SessionActParams $params
     *
     * @return BaseResponse<SessionActResponse>
     *
     * @throws APIException
     */
    public function act(
        string $sessionID,
        array|SessionActParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionActParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xStreamResponse' => 'x-stream-response'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['sessions/%1$s/act', $sessionID],
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
     * Closes the browser and cleans up all resources associated with the session.
     *
     * @param string $sessionID The session ID returned by /sessions/start
     *
     * @return BaseResponse<SessionEndResponse>
     *
     * @throws APIException
     */
    public function end(
        string $sessionID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['sessions/%1$s/end', $sessionID],
            options: $requestOptions,
            convert: SessionEndResponse::class,
        );
    }

    /**
     * @api
     *
     * Runs an autonomous agent that can perform multiple actions to
     * complete a complex task.
     *
     * @param string $sessionID Path param: The session ID returned by /sessions/start
     * @param array{
     *   agentConfig: array{
     *     cua?: bool,
     *     model?: string|array{
     *       apiKey?: string,
     *       baseURL?: string,
     *       model?: string,
     *       provider?: 'openai'|'anthropic'|'google'|\Stagehand\Sessions\ModelConfig\Provider,
     *     },
     *     provider?: 'openai'|'anthropic'|'google'|Provider,
     *     systemPrompt?: string,
     *   },
     *   executeOptions: array{
     *     instruction: string, highlightCursor?: bool, maxSteps?: int
     *   },
     *   frameID?: string,
     *   xStreamResponse?: 'true'|'false'|SessionExecuteAgentParams\XStreamResponse,
     * }|SessionExecuteAgentParams $params
     *
     * @return BaseResponse<SessionExecuteAgentResponse>
     *
     * @throws APIException
     */
    public function executeAgent(
        string $sessionID,
        array|SessionExecuteAgentParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionExecuteAgentParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xStreamResponse' => 'x-stream-response'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['sessions/%1$s/agentExecute', $sessionID],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: SessionExecuteAgentResponse::class,
        );
    }

    /**
     * @api
     *
     * Extracts data from the current page using natural language instructions
     * and optional JSON schema for structured output.
     *
     * @param string $sessionID Path param: The session ID returned by /sessions/start
     * @param array{
     *   frameID?: string,
     *   instruction?: string,
     *   options?: array{
     *     model?: array{
     *       apiKey?: string,
     *       baseURL?: string,
     *       model?: string,
     *       provider?: 'openai'|'anthropic'|'google'|\Stagehand\Sessions\ModelConfig\Provider,
     *     },
     *     selector?: string,
     *     timeout?: int,
     *   },
     *   schema?: array<string,mixed>,
     *   xStreamResponse?: 'true'|'false'|SessionExtractParams\XStreamResponse,
     * }|SessionExtractParams $params
     *
     * @return BaseResponse<Extraction|array<string,mixed>>
     *
     * @throws APIException
     */
    public function extract(
        string $sessionID,
        array|SessionExtractParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionExtractParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xStreamResponse' => 'x-stream-response'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['sessions/%1$s/extract', $sessionID],
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
     * Navigates the browser to the specified URL and waits for page load.
     *
     * @param string $sessionID Path param: The session ID returned by /sessions/start
     * @param array{
     *   url: string,
     *   frameID?: string,
     *   options?: array{
     *     waitUntil?: 'load'|'domcontentloaded'|'networkidle'|WaitUntil
     *   },
     *   xStreamResponse?: 'true'|'false'|SessionNavigateParams\XStreamResponse,
     * }|SessionNavigateParams $params
     *
     * @return BaseResponse<SessionNavigateResponse>
     *
     * @throws APIException
     */
    public function navigate(
        string $sessionID,
        array|SessionNavigateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionNavigateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xStreamResponse' => 'x-stream-response'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['sessions/%1$s/navigate', $sessionID],
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
     * Returns a list of candidate actions that can be performed on the page,
     * optionally filtered by natural language instruction.
     *
     * @param string $sessionID Path param: The session ID returned by /sessions/start
     * @param array{
     *   frameID?: string,
     *   instruction?: string,
     *   options?: array{
     *     model?: array{
     *       apiKey?: string,
     *       baseURL?: string,
     *       model?: string,
     *       provider?: 'openai'|'anthropic'|'google'|\Stagehand\Sessions\ModelConfig\Provider,
     *     },
     *     selector?: string,
     *     timeout?: int,
     *   },
     *   xStreamResponse?: 'true'|'false'|SessionObserveParams\XStreamResponse,
     * }|SessionObserveParams $params
     *
     * @return BaseResponse<list<Action>>
     *
     * @throws APIException
     */
    public function observe(
        string $sessionID,
        array|SessionObserveParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionObserveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xStreamResponse' => 'x-stream-response'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['sessions/%1$s/observe', $sessionID],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: new ListOf(Action::class),
        );
    }

    /**
     * @api
     *
     * Initializes a new Stagehand session with a browser instance.
     * Returns a session ID that must be used for all subsequent requests.
     *
     * @param array{
     *   env: 'LOCAL'|'BROWSERBASE'|Env,
     *   apiKey?: string,
     *   domSettleTimeout?: int,
     *   localBrowserLaunchOptions?: array{headless?: bool},
     *   model?: string,
     *   projectID?: string,
     *   selfHeal?: bool,
     *   systemPrompt?: string,
     *   verbose?: int,
     * }|SessionStartParams $params
     *
     * @return BaseResponse<SessionStartResponse>
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
            body: (object) $parsed,
            options: $options,
            convert: SessionStartResponse::class,
        );
    }
}
