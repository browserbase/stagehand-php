<?php

declare(strict_types=1);

namespace StagehandSDK\ServiceContracts;

use StagehandSDK\Core\Contracts\BaseStream;
use StagehandSDK\Core\Exceptions\APIException;
use StagehandSDK\RequestOptions;
use StagehandSDK\Sessions\Action;
use StagehandSDK\Sessions\SessionActParams\Options;
use StagehandSDK\Sessions\SessionActParams\XStreamResponse;
use StagehandSDK\Sessions\SessionActResponse;
use StagehandSDK\Sessions\SessionEndResponse;
use StagehandSDK\Sessions\SessionExecuteParams\AgentConfig;
use StagehandSDK\Sessions\SessionExecuteParams\ExecuteOptions;
use StagehandSDK\Sessions\SessionExecuteResponse;
use StagehandSDK\Sessions\SessionExtractResponse;
use StagehandSDK\Sessions\SessionNavigateResponse;
use StagehandSDK\Sessions\SessionObserveResponse;
use StagehandSDK\Sessions\SessionStartParams\Browser;
use StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams;
use StagehandSDK\Sessions\SessionStartResponse;
use StagehandSDK\Sessions\StreamEvent;

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
interface SessionsContract
{
    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param InputShape $input Body param: Natural language instruction or Action object
     * @param string $frameID Body param: Target frame ID for the action
     * @param Options|OptionsShape1 $options Body param
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
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
        ?\DateTimeInterface $xSentAt = null,
        XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionActResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param InputShape $input Body param: Natural language instruction or Action object
     * @param string $frameID Body param: Target frame ID for the action
     * @param Options|OptionsShape1 $options Body param
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
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
        ?\DateTimeInterface $xSentAt = null,
        XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param mixed $_forceBody Body param
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param \StagehandSDK\Sessions\SessionEndParams\XStreamResponse|value-of<\StagehandSDK\Sessions\SessionEndParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function end(
        string $id,
        mixed $_forceBody = null,
        ?\DateTimeInterface $xSentAt = null,
        \StagehandSDK\Sessions\SessionEndParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionEndResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param AgentConfig|AgentConfigShape $agentConfig Body param
     * @param ExecuteOptions|ExecuteOptionsShape $executeOptions Body param
     * @param string $frameID Body param: Target frame ID for the agent
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param \StagehandSDK\Sessions\SessionExecuteParams\XStreamResponse|value-of<\StagehandSDK\Sessions\SessionExecuteParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        AgentConfig|array $agentConfig,
        ExecuteOptions|array $executeOptions,
        ?string $frameID = null,
        ?\DateTimeInterface $xSentAt = null,
        \StagehandSDK\Sessions\SessionExecuteParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionExecuteResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param AgentConfig|AgentConfigShape $agentConfig Body param
     * @param ExecuteOptions|ExecuteOptionsShape $executeOptions Body param
     * @param string $frameID Body param: Target frame ID for the agent
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param \StagehandSDK\Sessions\SessionExecuteParams\XStreamResponse|value-of<\StagehandSDK\Sessions\SessionExecuteParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
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
        ?\DateTimeInterface $xSentAt = null,
        \StagehandSDK\Sessions\SessionExecuteParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param string $frameID Body param: Target frame ID for the extraction
     * @param string $instruction Body param: Natural language instruction for what to extract
     * @param \StagehandSDK\Sessions\SessionExtractParams\Options|OptionsShape2 $options Body param
     * @param array<string,mixed> $schema Body param: JSON Schema defining the structure of data to extract
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param \StagehandSDK\Sessions\SessionExtractParams\XStreamResponse|value-of<\StagehandSDK\Sessions\SessionExtractParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function extract(
        string $id,
        ?string $frameID = null,
        ?string $instruction = null,
        \StagehandSDK\Sessions\SessionExtractParams\Options|array|null $options = null,
        ?array $schema = null,
        ?\DateTimeInterface $xSentAt = null,
        \StagehandSDK\Sessions\SessionExtractParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionExtractResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param string $frameID Body param: Target frame ID for the extraction
     * @param string $instruction Body param: Natural language instruction for what to extract
     * @param \StagehandSDK\Sessions\SessionExtractParams\Options|OptionsShape2 $options Body param
     * @param array<string,mixed> $schema Body param: JSON Schema defining the structure of data to extract
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param \StagehandSDK\Sessions\SessionExtractParams\XStreamResponse|value-of<\StagehandSDK\Sessions\SessionExtractParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
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
        \StagehandSDK\Sessions\SessionExtractParams\Options|array|null $options = null,
        ?array $schema = null,
        ?\DateTimeInterface $xSentAt = null,
        \StagehandSDK\Sessions\SessionExtractParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param string $url Body param: URL to navigate to
     * @param string $frameID Body param: Target frame ID for the navigation
     * @param \StagehandSDK\Sessions\SessionNavigateParams\Options|OptionsShape $options Body param
     * @param bool $streamResponse Body param: Whether to stream the response via SSE
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param \StagehandSDK\Sessions\SessionNavigateParams\XStreamResponse|value-of<\StagehandSDK\Sessions\SessionNavigateParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function navigate(
        string $id,
        string $url,
        ?string $frameID = null,
        \StagehandSDK\Sessions\SessionNavigateParams\Options|array|null $options = null,
        ?bool $streamResponse = null,
        ?\DateTimeInterface $xSentAt = null,
        \StagehandSDK\Sessions\SessionNavigateParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionNavigateResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param string $frameID Body param: Target frame ID for the observation
     * @param string $instruction Body param: Natural language instruction for what actions to find
     * @param \StagehandSDK\Sessions\SessionObserveParams\Options|OptionsShape3 $options Body param
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param \StagehandSDK\Sessions\SessionObserveParams\XStreamResponse|value-of<\StagehandSDK\Sessions\SessionObserveParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function observe(
        string $id,
        ?string $frameID = null,
        ?string $instruction = null,
        \StagehandSDK\Sessions\SessionObserveParams\Options|array|null $options = null,
        ?\DateTimeInterface $xSentAt = null,
        \StagehandSDK\Sessions\SessionObserveParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionObserveResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param string $frameID Body param: Target frame ID for the observation
     * @param string $instruction Body param: Natural language instruction for what actions to find
     * @param \StagehandSDK\Sessions\SessionObserveParams\Options|OptionsShape3 $options Body param
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param \StagehandSDK\Sessions\SessionObserveParams\XStreamResponse|value-of<\StagehandSDK\Sessions\SessionObserveParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
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
        \StagehandSDK\Sessions\SessionObserveParams\Options|array|null $options = null,
        ?\DateTimeInterface $xSentAt = null,
        \StagehandSDK\Sessions\SessionObserveParams\XStreamResponse|string|null $xStreamResponse = null,
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
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param \StagehandSDK\Sessions\SessionStartParams\XStreamResponse|value-of<\StagehandSDK\Sessions\SessionStartParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
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
        ?\DateTimeInterface $xSentAt = null,
        \StagehandSDK\Sessions\SessionStartParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionStartResponse;
}
