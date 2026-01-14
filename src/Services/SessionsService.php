<?php

declare(strict_types=1);

namespace Stagehand\Services;

use Stagehand\Client;
use Stagehand\Core\Contracts\BaseStream;
use Stagehand\Core\Exceptions\APIException;
use Stagehand\Core\Util;
use Stagehand\RequestOptions;
use Stagehand\ServiceContracts\SessionsContract;
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
    ): SessionActResponse {
        $params = Util::removeNulls(
            [
                'input' => $input,
                'frameID' => $frameID,
                'options' => $options,
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
    ): BaseStream {
        $params = Util::removeNulls(
            [
                'input' => $input,
                'frameID' => $frameID,
                'options' => $options,
                'xSentAt' => $xSentAt,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->actStream($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Terminates the browser session and releases all associated resources.
     *
     * @param string $id Path param: Unique session identifier
     * @param mixed $_forceBody Body param
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param \Stagehand\Sessions\SessionEndParams\XStreamResponse|value-of<\Stagehand\Sessions\SessionEndParams\XStreamResponse> $xStreamResponse Header param: Whether to stream the response via SSE
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function end(
        string $id,
        mixed $_forceBody = null,
        ?\DateTimeInterface $xSentAt = null,
        \Stagehand\Sessions\SessionEndParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionEndResponse {
        $params = Util::removeNulls(
            [
                '_forceBody' => $_forceBody,
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
     * @param string $id Path param: Unique session identifier
     * @param AgentConfig|AgentConfigShape $agentConfig Body param
     * @param ExecuteOptions|ExecuteOptionsShape $executeOptions Body param
     * @param string $frameID Body param: Target frame ID for the agent
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
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
        ?\DateTimeInterface $xSentAt = null,
        \Stagehand\Sessions\SessionExecuteParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionExecuteResponse {
        $params = Util::removeNulls(
            [
                'agentConfig' => $agentConfig,
                'executeOptions' => $executeOptions,
                'frameID' => $frameID,
                'xSentAt' => $xSentAt,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->execute($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param AgentConfig|AgentConfigShape $agentConfig Body param
     * @param ExecuteOptions|ExecuteOptionsShape $executeOptions Body param
     * @param string $frameID Body param: Target frame ID for the agent
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
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
        ?\DateTimeInterface $xSentAt = null,
        \Stagehand\Sessions\SessionExecuteParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream {
        $params = Util::removeNulls(
            [
                'agentConfig' => $agentConfig,
                'executeOptions' => $executeOptions,
                'frameID' => $frameID,
                'xSentAt' => $xSentAt,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->executeStream($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Extracts structured data from the current page using AI-powered analysis.
     *
     * @param string $id Path param: Unique session identifier
     * @param string $frameID Body param: Target frame ID for the extraction
     * @param string $instruction Body param: Natural language instruction for what to extract
     * @param \Stagehand\Sessions\SessionExtractParams\Options|OptionsShape2 $options Body param
     * @param array<string,mixed> $schema Body param: JSON Schema defining the structure of data to extract
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
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
        ?\DateTimeInterface $xSentAt = null,
        \Stagehand\Sessions\SessionExtractParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionExtractResponse {
        $params = Util::removeNulls(
            [
                'frameID' => $frameID,
                'instruction' => $instruction,
                'options' => $options,
                'schema' => $schema,
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
     * @param string $id Path param: Unique session identifier
     * @param string $frameID Body param: Target frame ID for the extraction
     * @param string $instruction Body param: Natural language instruction for what to extract
     * @param \Stagehand\Sessions\SessionExtractParams\Options|OptionsShape2 $options Body param
     * @param array<string,mixed> $schema Body param: JSON Schema defining the structure of data to extract
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
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
        ?\DateTimeInterface $xSentAt = null,
        \Stagehand\Sessions\SessionExtractParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream {
        $params = Util::removeNulls(
            [
                'frameID' => $frameID,
                'instruction' => $instruction,
                'options' => $options,
                'schema' => $schema,
                'xSentAt' => $xSentAt,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->extractStream($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Navigates the browser to the specified URL.
     *
     * @param string $id Path param: Unique session identifier
     * @param string $url Body param: URL to navigate to
     * @param string $frameID Body param: Target frame ID for the navigation
     * @param \Stagehand\Sessions\SessionNavigateParams\Options|OptionsShape $options Body param
     * @param bool $streamResponse Body param: Whether to stream the response via SSE
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
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
        ?\DateTimeInterface $xSentAt = null,
        \Stagehand\Sessions\SessionNavigateParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionNavigateResponse {
        $params = Util::removeNulls(
            [
                'url' => $url,
                'frameID' => $frameID,
                'options' => $options,
                'streamResponse' => $streamResponse,
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
     * @param string $id Path param: Unique session identifier
     * @param string $frameID Body param: Target frame ID for the observation
     * @param string $instruction Body param: Natural language instruction for what actions to find
     * @param \Stagehand\Sessions\SessionObserveParams\Options|OptionsShape3 $options Body param
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
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
        ?\DateTimeInterface $xSentAt = null,
        \Stagehand\Sessions\SessionObserveParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionObserveResponse {
        $params = Util::removeNulls(
            [
                'frameID' => $frameID,
                'instruction' => $instruction,
                'options' => $options,
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
     * @param string $id Path param: Unique session identifier
     * @param string $frameID Body param: Target frame ID for the observation
     * @param string $instruction Body param: Natural language instruction for what actions to find
     * @param \Stagehand\Sessions\SessionObserveParams\Options|OptionsShape3 $options Body param
     * @param \DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
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
        ?\DateTimeInterface $xSentAt = null,
        \Stagehand\Sessions\SessionObserveParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): BaseStream {
        $params = Util::removeNulls(
            [
                'frameID' => $frameID,
                'instruction' => $instruction,
                'options' => $options,
                'xSentAt' => $xSentAt,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->observeStream($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Creates a new browser session with the specified configuration. Returns a session ID used for all subsequent operations.
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
        ?\DateTimeInterface $xSentAt = null,
        \Stagehand\Sessions\SessionStartParams\XStreamResponse|string|null $xStreamResponse = null,
        RequestOptions|array|null $requestOptions = null,
    ): SessionStartResponse {
        $params = Util::removeNulls(
            [
                'modelName' => $modelName,
                'actTimeoutMs' => $actTimeoutMs,
                'browser' => $browser,
                'browserbaseSessionCreateParams' => $browserbaseSessionCreateParams,
                'browserbaseSessionID' => $browserbaseSessionID,
                'domSettleTimeoutMs' => $domSettleTimeoutMs,
                'experimental' => $experimental,
                'selfHeal' => $selfHeal,
                'systemPrompt' => $systemPrompt,
                'verbose' => $verbose,
                'waitForCaptchaSolves' => $waitForCaptchaSolves,
                'xSentAt' => $xSentAt,
                'xStreamResponse' => $xStreamResponse,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->start(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
