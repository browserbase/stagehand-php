<?php

declare(strict_types=1);

namespace Stagehand\ServiceContracts;

use Stagehand\Core\Exceptions\APIException;
use Stagehand\RequestOptions;
use Stagehand\Sessions\Action;
use Stagehand\Sessions\SessionActParams\XStreamResponse;
use Stagehand\Sessions\SessionActResponse;
use Stagehand\Sessions\SessionEndResponse;
use Stagehand\Sessions\SessionExecuteAgentParams\AgentConfig\Provider;
use Stagehand\Sessions\SessionExecuteAgentResponse;
use Stagehand\Sessions\SessionExtractResponse\Extraction;
use Stagehand\Sessions\SessionNavigateParams\Options\WaitUntil;
use Stagehand\Sessions\SessionNavigateResponse;
use Stagehand\Sessions\SessionStartResponse;

interface SessionsContract
{
    /**
     * @api
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
    ): SessionActResponse;

    /**
     * @api
     *
     * @param string $sessionID The session ID returned by /sessions/start
     *
     * @throws APIException
     */
    public function end(
        string $sessionID,
        ?RequestOptions $requestOptions = null
    ): SessionEndResponse;

    /**
     * @api
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
    ): SessionExecuteAgentResponse;

    /**
     * @api
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
    ): Extraction|array;

    /**
     * @api
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
    ): SessionNavigateResponse;

    /**
     * @api
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
    ): array;

    /**
     * @api
     *
     * @param string $browserbaseAPIKey API key for Browserbase Cloud
     * @param string $browserbaseProjectID Project ID for Browserbase
     * @param int $domSettleTimeout Timeout in ms to wait for DOM to settle
     * @param string $model AI model to use for actions (must be prefixed with provider/)
     * @param bool $selfHeal Enable self-healing for failed actions
     * @param string $systemPrompt Custom system prompt for AI actions
     * @param int $verbose Logging verbosity level
     *
     * @throws APIException
     */
    public function start(
        string $browserbaseAPIKey,
        string $browserbaseProjectID,
        ?int $domSettleTimeout = null,
        ?string $model = null,
        ?bool $selfHeal = null,
        ?string $systemPrompt = null,
        int $verbose = 0,
        ?RequestOptions $requestOptions = null,
    ): SessionStartResponse;
}
