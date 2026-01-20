<?php

declare(strict_types=1);

namespace Stagehand\ServiceContracts;

use Stagehand\Core\Contracts\BaseStream;
use Stagehand\Core\Exceptions\APIException;
use Stagehand\RequestOptions;
use Stagehand\Sessions\Action;
use Stagehand\Sessions\SessionActParams\Options;
use Stagehand\Sessions\SessionActParams\XStreamResponse;
use Stagehand\Sessions\SessionActResponse;
use Stagehand\Sessions\SessionEndResponse;
use Stagehand\Sessions\SessionExecuteParams\AgentConfig;
use Stagehand\Sessions\SessionExecuteParams\ExecuteOptions;
use Stagehand\Sessions\SessionExecuteResponse;
use Stagehand\Sessions\SessionExtractResponse;
use Stagehand\Sessions\SessionNavigateResponse;
use Stagehand\Sessions\SessionObserveResponse;
use Stagehand\Sessions\SessionStartParams\Browser;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams;
use Stagehand\Sessions\SessionStartResponse;
use Stagehand\Sessions\StreamEvent;

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
interface SessionsContract
{
    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param InputShape $input Body param: Natural language instruction or Action object
     * @param string|null $frameID Body param: Target frame ID for the action
     * @param Options|OptionsShape1 $options Body param
     * @param XStreamResponse|value-of<XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function act(
        string $id,
        string|Action|array $input,
        ?string $frameID = null,
        Options|array|null $options = null,
        XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionActResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param InputShape $input Body param: Natural language instruction or Action object
     * @param string|null $frameID Body param: Target frame ID for the action
     * @param Options|OptionsShape1 $options Body param
     * @param XStreamResponse|value-of<XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseStream<StreamEvent>
     *
     * @throws APIException
     */
    public function actStream(
        string $id,
        string|Action|array $input,
        ?string $frameID = null,
        Options|array|null $options = null,
        XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream;

    /**
     * @api
     *
     * @param string $id Unique session identifier
     * @param \Stagehand\Sessions\SessionEndParams\XStreamResponse|value-of<\Stagehand\Sessions\SessionEndParams\XStreamResponse> $xStreamResponse Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function end(
        string $id,
        \Stagehand\Sessions\SessionEndParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionEndResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param AgentConfig|AgentConfigShape $agentConfig Body param
     * @param ExecuteOptions|ExecuteOptionsShape $executeOptions Body param
     * @param string|null $frameID Body param: Target frame ID for the agent
     * @param \Stagehand\Sessions\SessionExecuteParams\XStreamResponse|value-of<\Stagehand\Sessions\SessionExecuteParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        AgentConfig|array $agentConfig,
        ExecuteOptions|array $executeOptions,
        ?string $frameID = null,
        \Stagehand\Sessions\SessionExecuteParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionExecuteResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param AgentConfig|AgentConfigShape $agentConfig Body param
     * @param ExecuteOptions|ExecuteOptionsShape $executeOptions Body param
     * @param string|null $frameID Body param: Target frame ID for the agent
     * @param \Stagehand\Sessions\SessionExecuteParams\XStreamResponse|value-of<\Stagehand\Sessions\SessionExecuteParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseStream<StreamEvent>
     *
     * @throws APIException
     */
    public function executeStream(
        string $id,
        AgentConfig|array $agentConfig,
        ExecuteOptions|array $executeOptions,
        ?string $frameID = null,
        \Stagehand\Sessions\SessionExecuteParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param string|null $frameID Body param: Target frame ID for the extraction
     * @param string $instruction Body param: Natural language instruction for what to extract
     * @param \Stagehand\Sessions\SessionExtractParams\Options|OptionsShape2 $options Body param
     * @param array<string,mixed> $schema Body param: JSON Schema defining the structure of data to extract
     * @param \Stagehand\Sessions\SessionExtractParams\XStreamResponse|value-of<\Stagehand\Sessions\SessionExtractParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function extract(
        string $id,
        ?string $frameID = null,
        ?string $instruction = null,
        \Stagehand\Sessions\SessionExtractParams\Options|array|null $options = null,
        ?array $schema = null,
        \Stagehand\Sessions\SessionExtractParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionExtractResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param string|null $frameID Body param: Target frame ID for the extraction
     * @param string $instruction Body param: Natural language instruction for what to extract
     * @param \Stagehand\Sessions\SessionExtractParams\Options|OptionsShape2 $options Body param
     * @param array<string,mixed> $schema Body param: JSON Schema defining the structure of data to extract
     * @param \Stagehand\Sessions\SessionExtractParams\XStreamResponse|value-of<\Stagehand\Sessions\SessionExtractParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseStream<StreamEvent>
     *
     * @throws APIException
     */
    public function extractStream(
        string $id,
        ?string $frameID = null,
        ?string $instruction = null,
        \Stagehand\Sessions\SessionExtractParams\Options|array|null $options = null,
        ?array $schema = null,
        \Stagehand\Sessions\SessionExtractParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param string $url Body param: URL to navigate to
     * @param string|null $frameID Body param: Target frame ID for the navigation
     * @param \Stagehand\Sessions\SessionNavigateParams\Options|OptionsShape $options Body param
     * @param bool $streamResponse Body param: Whether to stream the response via SSE
     * @param \Stagehand\Sessions\SessionNavigateParams\XStreamResponse|value-of<\Stagehand\Sessions\SessionNavigateParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function navigate(
        string $id,
        string $url,
        ?string $frameID = null,
        \Stagehand\Sessions\SessionNavigateParams\Options|array|null $options = null,
        ?bool $streamResponse = null,
        \Stagehand\Sessions\SessionNavigateParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionNavigateResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param string|null $frameID Body param: Target frame ID for the observation
     * @param string $instruction Body param: Natural language instruction for what actions to find
     * @param \Stagehand\Sessions\SessionObserveParams\Options|OptionsShape3 $options Body param
     * @param \Stagehand\Sessions\SessionObserveParams\XStreamResponse|value-of<\Stagehand\Sessions\SessionObserveParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function observe(
        string $id,
        ?string $frameID = null,
        ?string $instruction = null,
        \Stagehand\Sessions\SessionObserveParams\Options|array|null $options = null,
        \Stagehand\Sessions\SessionObserveParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionObserveResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param string|null $frameID Body param: Target frame ID for the observation
     * @param string $instruction Body param: Natural language instruction for what actions to find
     * @param \Stagehand\Sessions\SessionObserveParams\Options|OptionsShape3 $options Body param
     * @param \Stagehand\Sessions\SessionObserveParams\XStreamResponse|value-of<\Stagehand\Sessions\SessionObserveParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseStream<StreamEvent>
     *
     * @throws APIException
     */
    public function observeStream(
        string $id,
        ?string $frameID = null,
        ?string $instruction = null,
        \Stagehand\Sessions\SessionObserveParams\Options|array|null $options = null,
        \Stagehand\Sessions\SessionObserveParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream;

    /**
     * @api
     *
     * @param string $modelName Body param: Model name to use for AI operations
     * @param float $actTimeoutMs Body param: Timeout in ms for act operations (deprecated, v2 only)
     * @param Browser|BrowserShape $browser Body param
     * @param BrowserbaseSessionCreateParams|BrowserbaseSessionCreateParamsShape $browserbaseSessionCreateParams Body param
     * @param string $browserbaseSessionID Body param: Existing Browserbase session ID to resume
     * @param float $domSettleTimeoutMs Body param: Timeout in ms to wait for DOM to settle
     * @param bool $experimental Body param
     * @param bool $selfHeal Body param: Enable self-healing for failed actions
     * @param string $systemPrompt Body param: Custom system prompt for AI operations
     * @param float $verbose Body param: Logging verbosity level (0=quiet, 1=normal, 2=debug)
     * @param bool $waitForCaptchaSolves Body param: Wait for captcha solves (deprecated, v2 only)
     * @param \Stagehand\Sessions\SessionStartParams\XStreamResponse|value-of<\Stagehand\Sessions\SessionStartParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function start(
        string $modelName,
        ?float $actTimeoutMs = null,
        Browser|array|null $browser = null,
        BrowserbaseSessionCreateParams|array|null $browserbaseSessionCreateParams = null,
        ?string $browserbaseSessionID = null,
        ?float $domSettleTimeoutMs = null,
        ?bool $experimental = null,
        ?bool $selfHeal = null,
        ?string $systemPrompt = null,
        ?float $verbose = null,
        ?bool $waitForCaptchaSolves = null,
        \Stagehand\Sessions\SessionStartParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionStartResponse;
}
