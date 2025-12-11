<?php

declare(strict_types=1);

namespace Stagehand\Services;

use Stagehand\Client;
use Stagehand\Core\Exceptions\APIException;
use Stagehand\Core\Util;
use Stagehand\RequestOptions;
use Stagehand\ServiceContracts\SessionsContract;
use Stagehand\Sessions\Action;
use Stagehand\Sessions\SessionActParams\XStreamResponse;
use Stagehand\Sessions\SessionActResponse;
use Stagehand\Sessions\SessionEndResponse;
use Stagehand\Sessions\SessionExecuteAgentParams\AgentConfig\Provider;
use Stagehand\Sessions\SessionExecuteAgentResponse;
use Stagehand\Sessions\SessionExtractResponse\Extraction;
use Stagehand\Sessions\SessionNavigateParams\Options\WaitUntil;
use Stagehand\Sessions\SessionNavigateResponse;
use Stagehand\Sessions\SessionStartParams\Env;
use Stagehand\Sessions\SessionStartResponse;

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
     * Performs a browser action based on natural language instruction or
     * a specific action object returned by observe().
     *
     * @param string $sessionID Path param: The session ID returned by /sessions/start
     * @param string|array{
     *   arguments: list<string>,
     *   description: string,
     *   method: string,
     *   selector: string,
     *   backendNodeID?: int,
     * }|Action $input Body param: Natural language instruction
     * @param string $frameID Body param: Frame ID to act on (optional)
     * @param array{
     *   model?: array{
     *     apiKey?: string,
     *     baseURL?: string,
     *     model?: string,
     *     provider?: 'openai'|'anthropic'|'google'|\Stagehand\Sessions\ModelConfig\Provider,
     *   },
     *   timeout?: int,
     *   variables?: array<string,string>,
     * } $options Body param:
     * @param 'true'|'false'|XStreamResponse $xStreamResponse Header param: Enable Server-Sent Events streaming for real-time logs
     *
     * @throws APIException
     */
    public function act(
        string $sessionID,
        string|array|Action $input,
        ?string $frameID = null,
        ?array $options = null,
        string|XStreamResponse $xStreamResponse = 'true',
        ?RequestOptions $requestOptions = null,
    ): SessionActResponse {
        $params = Util::removeNulls(
            [
                'input' => $input,
                'frameID' => $frameID,
                'options' => $options,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->act($sessionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Closes the browser and cleans up all resources associated with the session.
     *
     * @param string $sessionID The session ID returned by /sessions/start
     *
     * @throws APIException
     */
    public function end(
        string $sessionID,
        ?RequestOptions $requestOptions = null
    ): SessionEndResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->end($sessionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Runs an autonomous agent that can perform multiple actions to
     * complete a complex task.
     *
     * @param string $sessionID Path param: The session ID returned by /sessions/start
     * @param array{
     *   cua?: bool,
     *   model?: string|array{
     *     apiKey?: string,
     *     baseURL?: string,
     *     model?: string,
     *     provider?: 'openai'|'anthropic'|'google'|\Stagehand\Sessions\ModelConfig\Provider,
     *   },
     *   provider?: 'openai'|'anthropic'|'google'|Provider,
     *   systemPrompt?: string,
     * } $agentConfig Body param:
     * @param array{
     *   instruction: string, highlightCursor?: bool, maxSteps?: int
     * } $executeOptions Body param:
     * @param string $frameID Body param:
     * @param 'true'|'false'|\Stagehand\Sessions\SessionExecuteAgentParams\XStreamResponse $xStreamResponse Header param: Enable Server-Sent Events streaming for real-time logs
     *
     * @throws APIException
     */
    public function executeAgent(
        string $sessionID,
        array $agentConfig,
        array $executeOptions,
        ?string $frameID = null,
        string|\Stagehand\Sessions\SessionExecuteAgentParams\XStreamResponse $xStreamResponse = 'true',
        ?RequestOptions $requestOptions = null,
    ): SessionExecuteAgentResponse {
        $params = Util::removeNulls(
            [
                'agentConfig' => $agentConfig,
                'executeOptions' => $executeOptions,
                'frameID' => $frameID,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->executeAgent($sessionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Extracts data from the current page using natural language instructions
     * and optional JSON schema for structured output.
     *
     * @param string $sessionID Path param: The session ID returned by /sessions/start
     * @param string $frameID Body param: Frame ID to extract from
     * @param string $instruction Body param: Natural language instruction for extraction
     * @param array{
     *   model?: array{
     *     apiKey?: string,
     *     baseURL?: string,
     *     model?: string,
     *     provider?: 'openai'|'anthropic'|'google'|\Stagehand\Sessions\ModelConfig\Provider,
     *   },
     *   selector?: string,
     *   timeout?: int,
     * } $options Body param:
     * @param array<string,mixed> $schema Body param: JSON Schema for structured output
     * @param 'true'|'false'|\Stagehand\Sessions\SessionExtractParams\XStreamResponse $xStreamResponse Header param: Enable Server-Sent Events streaming for real-time logs
     *
     * @return Extraction|array<string,mixed>
     *
     * @throws APIException
     */
    public function extract(
        string $sessionID,
        ?string $frameID = null,
        ?string $instruction = null,
        ?array $options = null,
        ?array $schema = null,
        string|\Stagehand\Sessions\SessionExtractParams\XStreamResponse $xStreamResponse = 'true',
        ?RequestOptions $requestOptions = null,
    ): Extraction|array {
        $params = Util::removeNulls(
            [
                'frameID' => $frameID,
                'instruction' => $instruction,
                'options' => $options,
                'schema' => $schema,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->extract($sessionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Navigates the browser to the specified URL and waits for page load.
     *
     * @param string $sessionID Path param: The session ID returned by /sessions/start
     * @param string $url Body param: URL to navigate to
     * @param string $frameID Body param:
     * @param array{
     *   waitUntil?: 'load'|'domcontentloaded'|'networkidle'|WaitUntil
     * } $options Body param:
     * @param 'true'|'false'|\Stagehand\Sessions\SessionNavigateParams\XStreamResponse $xStreamResponse Header param: Enable Server-Sent Events streaming for real-time logs
     *
     * @throws APIException
     */
    public function navigate(
        string $sessionID,
        string $url,
        ?string $frameID = null,
        ?array $options = null,
        string|\Stagehand\Sessions\SessionNavigateParams\XStreamResponse $xStreamResponse = 'true',
        ?RequestOptions $requestOptions = null,
    ): SessionNavigateResponse {
        $params = Util::removeNulls(
            [
                'url' => $url,
                'frameID' => $frameID,
                'options' => $options,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->navigate($sessionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns a list of candidate actions that can be performed on the page,
     * optionally filtered by natural language instruction.
     *
     * @param string $sessionID Path param: The session ID returned by /sessions/start
     * @param string $frameID Body param: Frame ID to observe
     * @param string $instruction Body param: Natural language instruction to filter actions
     * @param array{
     *   model?: array{
     *     apiKey?: string,
     *     baseURL?: string,
     *     model?: string,
     *     provider?: 'openai'|'anthropic'|'google'|\Stagehand\Sessions\ModelConfig\Provider,
     *   },
     *   selector?: string,
     *   timeout?: int,
     * } $options Body param:
     * @param 'true'|'false'|\Stagehand\Sessions\SessionObserveParams\XStreamResponse $xStreamResponse Header param: Enable Server-Sent Events streaming for real-time logs
     *
     * @return list<Action>
     *
     * @throws APIException
     */
    public function observe(
        string $sessionID,
        ?string $frameID = null,
        ?string $instruction = null,
        ?array $options = null,
        string|\Stagehand\Sessions\SessionObserveParams\XStreamResponse $xStreamResponse = 'true',
        ?RequestOptions $requestOptions = null,
    ): array {
        $params = Util::removeNulls(
            [
                'frameID' => $frameID,
                'instruction' => $instruction,
                'options' => $options,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->observe($sessionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Initializes a new Stagehand session with a browser instance.
     * Returns a session ID that must be used for all subsequent requests.
     *
     * @param 'LOCAL'|'BROWSERBASE'|Env $env Environment to run the browser in
     * @param string $apiKey API key for Browserbase (required when env=BROWSERBASE)
     * @param int $domSettleTimeout Timeout in ms to wait for DOM to settle
     * @param array{
     *   headless?: bool
     * } $localBrowserLaunchOptions Options for local browser launch
     * @param string $model AI model to use for actions
     * @param string $projectID Project ID for Browserbase (required when env=BROWSERBASE)
     * @param bool $selfHeal Enable self-healing for failed actions
     * @param string $systemPrompt Custom system prompt for AI actions
     * @param int $verbose Logging verbosity level
     *
     * @throws APIException
     */
    public function start(
        string|Env $env,
        ?string $apiKey = null,
        ?int $domSettleTimeout = null,
        ?array $localBrowserLaunchOptions = null,
        ?string $model = null,
        ?string $projectID = null,
        ?bool $selfHeal = null,
        ?string $systemPrompt = null,
        int $verbose = 0,
        ?RequestOptions $requestOptions = null,
    ): SessionStartResponse {
        $params = Util::removeNulls(
            [
                'env' => $env,
                'apiKey' => $apiKey,
                'domSettleTimeout' => $domSettleTimeout,
                'localBrowserLaunchOptions' => $localBrowserLaunchOptions,
                'model' => $model,
                'projectID' => $projectID,
                'selfHeal' => $selfHeal,
                'systemPrompt' => $systemPrompt,
                'verbose' => $verbose,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->start(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
