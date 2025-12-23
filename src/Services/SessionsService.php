<?php

declare(strict_types=1);

namespace Stagehand\Services;

use Stagehand\Client;
use Stagehand\Core\Contracts\BaseStream;
use Stagehand\Core\Exceptions\APIException;
use Stagehand\Core\Util;
use Stagehand\RequestOptions;
use Stagehand\ServiceContracts\SessionsContract;
use Stagehand\Sessions\ModelConfig\ModelConfigObject\Provider;
use Stagehand\Sessions\SessionActParams\XLanguage;
use Stagehand\Sessions\SessionActParams\XStreamResponse;
use Stagehand\Sessions\SessionActResponse;
use Stagehand\Sessions\SessionEndResponse;
use Stagehand\Sessions\SessionExecuteResponse;
use Stagehand\Sessions\SessionExtractResponse;
use Stagehand\Sessions\SessionNavigateParams\Options\WaitUntil;
use Stagehand\Sessions\SessionNavigateResponse;
use Stagehand\Sessions\SessionObserveResponse;
use Stagehand\Sessions\SessionStartParams\Browser\Type;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint\Browser;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint\Device;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint\HTTPVersion;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint\OperatingSystem;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Region;
use Stagehand\Sessions\SessionStartResponse;
use Stagehand\Sessions\StreamEvent;

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
     * @param string|array{
     *   description: string,
     *   selector: string,
     *   arguments?: list<string>,
     *   backendNodeID?: float,
     *   method?: string,
     * } $input Body param: Natural language instruction or Action object
     * @param string $frameID Body param: Target frame ID for the action
     * @param array{
     *   model?: string|array{
     *     modelName: string,
     *     apiKey?: string,
     *     baseURL?: string,
     *     provider?: 'openai'|'anthropic'|'google'|'microsoft'|Provider,
     *   },
     *   timeout?: float,
     *   variables?: array<string,string>,
     * } $options Body param:
     * @param 'typescript'|'python'|'playground'|XLanguage $xLanguage Header param: Client SDK language
     * @param string $xSDKVersion Header param: Version of the Stagehand SDK
     * @param string|\DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param 'true'|'false'|XStreamResponse $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @throws APIException
     */
    public function act(
        string $id,
        string|array $input,
        ?string $frameID = null,
        ?array $options = null,
        string|XLanguage|null $xLanguage = null,
        ?string $xSDKVersion = null,
        string|\DateTimeInterface|null $xSentAt = null,
        string|XStreamResponse|null $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): SessionActResponse {
        $params = Util::removeNulls(
            [
                'input' => $input,
                'frameID' => $frameID,
                'options' => $options,
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
     * @param string $id Path param: Unique session identifier
     * @param string|array{
     *   description: string,
     *   selector: string,
     *   arguments?: list<string>,
     *   backendNodeID?: float,
     *   method?: string,
     * } $input Body param: Natural language instruction or Action object
     * @param string $frameID Body param: Target frame ID for the action
     * @param array{
     *   model?: string|array{
     *     modelName: string,
     *     apiKey?: string,
     *     baseURL?: string,
     *     provider?: 'openai'|'anthropic'|'google'|'microsoft'|Provider,
     *   },
     *   timeout?: float,
     *   variables?: array<string,string>,
     * } $options Body param:
     * @param 'typescript'|'python'|'playground'|XLanguage $xLanguage Header param: Client SDK language
     * @param string $xSDKVersion Header param: Version of the Stagehand SDK
     * @param string|\DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param 'true'|'false'|XStreamResponse $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @return BaseStream<StreamEvent>
     *
     * @throws APIException
     */
    public function actStream(
        string $id,
        string|array $input,
        ?string $frameID = null,
        ?array $options = null,
        string|XLanguage|null $xLanguage = null,
        ?string $xSDKVersion = null,
        string|\DateTimeInterface|null $xSentAt = null,
        string|XStreamResponse|null $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): BaseStream {
        $params = Util::removeNulls(
            [
                'input' => $input,
                'frameID' => $frameID,
                'options' => $options,
                'xLanguage' => $xLanguage,
                'xSDKVersion' => $xSDKVersion,
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
     * @param string $id Unique session identifier
     * @param 'typescript'|'python'|'playground'|\Stagehand\Sessions\SessionEndParams\XLanguage $xLanguage Client SDK language
     * @param string $xSDKVersion Version of the Stagehand SDK
     * @param string|\DateTimeInterface $xSentAt ISO timestamp when request was sent
     * @param 'true'|'false'|\Stagehand\Sessions\SessionEndParams\XStreamResponse $xStreamResponse Whether to stream the response via SSE
     *
     * @throws APIException
     */
    public function end(
        string $id,
        string|\Stagehand\Sessions\SessionEndParams\XLanguage|null $xLanguage = null,
        ?string $xSDKVersion = null,
        string|\DateTimeInterface|null $xSentAt = null,
        string|\Stagehand\Sessions\SessionEndParams\XStreamResponse|null $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): SessionEndResponse {
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
     * @param string $id Path param: Unique session identifier
     * @param array{
     *   cua?: bool,
     *   model?: string|array{
     *     modelName: string,
     *     apiKey?: string,
     *     baseURL?: string,
     *     provider?: 'openai'|'anthropic'|'google'|'microsoft'|Provider,
     *   },
     *   provider?: 'openai'|'anthropic'|'google'|'microsoft'|\Stagehand\Sessions\SessionExecuteParams\AgentConfig\Provider,
     *   systemPrompt?: string,
     * } $agentConfig Body param:
     * @param array{
     *   instruction: string, highlightCursor?: bool, maxSteps?: float
     * } $executeOptions Body param:
     * @param string $frameID Body param: Target frame ID for the agent
     * @param 'typescript'|'python'|'playground'|\Stagehand\Sessions\SessionExecuteParams\XLanguage $xLanguage Header param: Client SDK language
     * @param string $xSDKVersion Header param: Version of the Stagehand SDK
     * @param string|\DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param 'true'|'false'|\Stagehand\Sessions\SessionExecuteParams\XStreamResponse $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        array $agentConfig,
        array $executeOptions,
        ?string $frameID = null,
        string|\Stagehand\Sessions\SessionExecuteParams\XLanguage|null $xLanguage = null,
        ?string $xSDKVersion = null,
        string|\DateTimeInterface|null $xSentAt = null,
        string|\Stagehand\Sessions\SessionExecuteParams\XStreamResponse|null $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): SessionExecuteResponse {
        $params = Util::removeNulls(
            [
                'agentConfig' => $agentConfig,
                'executeOptions' => $executeOptions,
                'frameID' => $frameID,
                'xLanguage' => $xLanguage,
                'xSDKVersion' => $xSDKVersion,
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
     * @param array{
     *   cua?: bool,
     *   model?: string|array{
     *     modelName: string,
     *     apiKey?: string,
     *     baseURL?: string,
     *     provider?: 'openai'|'anthropic'|'google'|'microsoft'|Provider,
     *   },
     *   provider?: 'openai'|'anthropic'|'google'|'microsoft'|\Stagehand\Sessions\SessionExecuteParams\AgentConfig\Provider,
     *   systemPrompt?: string,
     * } $agentConfig Body param:
     * @param array{
     *   instruction: string, highlightCursor?: bool, maxSteps?: float
     * } $executeOptions Body param:
     * @param string $frameID Body param: Target frame ID for the agent
     * @param 'typescript'|'python'|'playground'|\Stagehand\Sessions\SessionExecuteParams\XLanguage $xLanguage Header param: Client SDK language
     * @param string $xSDKVersion Header param: Version of the Stagehand SDK
     * @param string|\DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param 'true'|'false'|\Stagehand\Sessions\SessionExecuteParams\XStreamResponse $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @return BaseStream<StreamEvent>
     *
     * @throws APIException
     */
    public function executeStream(
        string $id,
        array $agentConfig,
        array $executeOptions,
        ?string $frameID = null,
        string|\Stagehand\Sessions\SessionExecuteParams\XLanguage|null $xLanguage = null,
        ?string $xSDKVersion = null,
        string|\DateTimeInterface|null $xSentAt = null,
        string|\Stagehand\Sessions\SessionExecuteParams\XStreamResponse|null $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): BaseStream {
        $params = Util::removeNulls(
            [
                'agentConfig' => $agentConfig,
                'executeOptions' => $executeOptions,
                'frameID' => $frameID,
                'xLanguage' => $xLanguage,
                'xSDKVersion' => $xSDKVersion,
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
     * @param array{
     *   model?: string|array{
     *     modelName: string,
     *     apiKey?: string,
     *     baseURL?: string,
     *     provider?: 'openai'|'anthropic'|'google'|'microsoft'|Provider,
     *   },
     *   selector?: string,
     *   timeout?: float,
     * } $options Body param:
     * @param array<string,mixed> $schema Body param: JSON Schema defining the structure of data to extract
     * @param 'typescript'|'python'|'playground'|\Stagehand\Sessions\SessionExtractParams\XLanguage $xLanguage Header param: Client SDK language
     * @param string $xSDKVersion Header param: Version of the Stagehand SDK
     * @param string|\DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param 'true'|'false'|\Stagehand\Sessions\SessionExtractParams\XStreamResponse $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @throws APIException
     */
    public function extract(
        string $id,
        ?string $frameID = null,
        ?string $instruction = null,
        ?array $options = null,
        ?array $schema = null,
        string|\Stagehand\Sessions\SessionExtractParams\XLanguage|null $xLanguage = null,
        ?string $xSDKVersion = null,
        string|\DateTimeInterface|null $xSentAt = null,
        string|\Stagehand\Sessions\SessionExtractParams\XStreamResponse|null $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): SessionExtractResponse {
        $params = Util::removeNulls(
            [
                'frameID' => $frameID,
                'instruction' => $instruction,
                'options' => $options,
                'schema' => $schema,
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
     * @param string $id Path param: Unique session identifier
     * @param string $frameID Body param: Target frame ID for the extraction
     * @param string $instruction Body param: Natural language instruction for what to extract
     * @param array{
     *   model?: string|array{
     *     modelName: string,
     *     apiKey?: string,
     *     baseURL?: string,
     *     provider?: 'openai'|'anthropic'|'google'|'microsoft'|Provider,
     *   },
     *   selector?: string,
     *   timeout?: float,
     * } $options Body param:
     * @param array<string,mixed> $schema Body param: JSON Schema defining the structure of data to extract
     * @param 'typescript'|'python'|'playground'|\Stagehand\Sessions\SessionExtractParams\XLanguage $xLanguage Header param: Client SDK language
     * @param string $xSDKVersion Header param: Version of the Stagehand SDK
     * @param string|\DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param 'true'|'false'|\Stagehand\Sessions\SessionExtractParams\XStreamResponse $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @return BaseStream<StreamEvent>
     *
     * @throws APIException
     */
    public function extractStream(
        string $id,
        ?string $frameID = null,
        ?string $instruction = null,
        ?array $options = null,
        ?array $schema = null,
        string|\Stagehand\Sessions\SessionExtractParams\XLanguage|null $xLanguage = null,
        ?string $xSDKVersion = null,
        string|\DateTimeInterface|null $xSentAt = null,
        string|\Stagehand\Sessions\SessionExtractParams\XStreamResponse|null $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): BaseStream {
        $params = Util::removeNulls(
            [
                'frameID' => $frameID,
                'instruction' => $instruction,
                'options' => $options,
                'schema' => $schema,
                'xLanguage' => $xLanguage,
                'xSDKVersion' => $xSDKVersion,
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
     * @param array{
     *   referer?: string,
     *   timeout?: float,
     *   waitUntil?: 'load'|'domcontentloaded'|'networkidle'|WaitUntil,
     * } $options Body param:
     * @param bool $streamResponse Body param: Whether to stream the response via SSE
     * @param 'typescript'|'python'|'playground'|\Stagehand\Sessions\SessionNavigateParams\XLanguage $xLanguage Header param: Client SDK language
     * @param string $xSDKVersion Header param: Version of the Stagehand SDK
     * @param string|\DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param 'true'|'false'|\Stagehand\Sessions\SessionNavigateParams\XStreamResponse $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @throws APIException
     */
    public function navigate(
        string $id,
        string $url,
        ?string $frameID = null,
        ?array $options = null,
        ?bool $streamResponse = null,
        string|\Stagehand\Sessions\SessionNavigateParams\XLanguage|null $xLanguage = null,
        ?string $xSDKVersion = null,
        string|\DateTimeInterface|null $xSentAt = null,
        string|\Stagehand\Sessions\SessionNavigateParams\XStreamResponse|null $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): SessionNavigateResponse {
        $params = Util::removeNulls(
            [
                'url' => $url,
                'frameID' => $frameID,
                'options' => $options,
                'streamResponse' => $streamResponse,
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
     * @param string $id Path param: Unique session identifier
     * @param string $frameID Body param: Target frame ID for the observation
     * @param string $instruction Body param: Natural language instruction for what actions to find
     * @param array{
     *   model?: string|array{
     *     modelName: string,
     *     apiKey?: string,
     *     baseURL?: string,
     *     provider?: 'openai'|'anthropic'|'google'|'microsoft'|Provider,
     *   },
     *   selector?: string,
     *   timeout?: float,
     * } $options Body param:
     * @param 'typescript'|'python'|'playground'|\Stagehand\Sessions\SessionObserveParams\XLanguage $xLanguage Header param: Client SDK language
     * @param string $xSDKVersion Header param: Version of the Stagehand SDK
     * @param string|\DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param 'true'|'false'|\Stagehand\Sessions\SessionObserveParams\XStreamResponse $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @throws APIException
     */
    public function observe(
        string $id,
        ?string $frameID = null,
        ?string $instruction = null,
        ?array $options = null,
        string|\Stagehand\Sessions\SessionObserveParams\XLanguage|null $xLanguage = null,
        ?string $xSDKVersion = null,
        string|\DateTimeInterface|null $xSentAt = null,
        string|\Stagehand\Sessions\SessionObserveParams\XStreamResponse|null $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): SessionObserveResponse {
        $params = Util::removeNulls(
            [
                'frameID' => $frameID,
                'instruction' => $instruction,
                'options' => $options,
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
     * @param string $id Path param: Unique session identifier
     * @param string $frameID Body param: Target frame ID for the observation
     * @param string $instruction Body param: Natural language instruction for what actions to find
     * @param array{
     *   model?: string|array{
     *     modelName: string,
     *     apiKey?: string,
     *     baseURL?: string,
     *     provider?: 'openai'|'anthropic'|'google'|'microsoft'|Provider,
     *   },
     *   selector?: string,
     *   timeout?: float,
     * } $options Body param:
     * @param 'typescript'|'python'|'playground'|\Stagehand\Sessions\SessionObserveParams\XLanguage $xLanguage Header param: Client SDK language
     * @param string $xSDKVersion Header param: Version of the Stagehand SDK
     * @param string|\DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param 'true'|'false'|\Stagehand\Sessions\SessionObserveParams\XStreamResponse $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @return BaseStream<StreamEvent>
     *
     * @throws APIException
     */
    public function observeStream(
        string $id,
        ?string $frameID = null,
        ?string $instruction = null,
        ?array $options = null,
        string|\Stagehand\Sessions\SessionObserveParams\XLanguage|null $xLanguage = null,
        ?string $xSDKVersion = null,
        string|\DateTimeInterface|null $xSentAt = null,
        string|\Stagehand\Sessions\SessionObserveParams\XStreamResponse|null $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
    ): BaseStream {
        $params = Util::removeNulls(
            [
                'frameID' => $frameID,
                'instruction' => $instruction,
                'options' => $options,
                'xLanguage' => $xLanguage,
                'xSDKVersion' => $xSDKVersion,
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
     * @param array{
     *   cdpURL?: string,
     *   launchOptions?: array{
     *     acceptDownloads?: bool,
     *     args?: list<string>,
     *     cdpURL?: string,
     *     chromiumSandbox?: bool,
     *     connectTimeoutMs?: float,
     *     deviceScaleFactor?: float,
     *     devtools?: bool,
     *     downloadsPath?: string,
     *     executablePath?: string,
     *     hasTouch?: bool,
     *     headless?: bool,
     *     ignoreDefaultArgs?: bool|list<string>,
     *     ignoreHTTPSErrors?: bool,
     *     locale?: string,
     *     preserveUserDataDir?: bool,
     *     proxy?: array{
     *       server: string, bypass?: string, password?: string, username?: string
     *     },
     *     userDataDir?: string,
     *     viewport?: array{height: float, width: float},
     *   },
     *   type?: 'local'|'browserbase'|Type,
     * } $browser Body param:
     * @param array{
     *   browserSettings?: array{
     *     advancedStealth?: bool,
     *     blockAds?: bool,
     *     context?: array{id: string, persist?: bool},
     *     extensionID?: string,
     *     fingerprint?: array{
     *       browsers?: list<'chrome'|'edge'|'firefox'|'safari'|Browser>,
     *       devices?: list<'desktop'|'mobile'|Device>,
     *       httpVersion?: '1'|'2'|HTTPVersion,
     *       locales?: list<string>,
     *       operatingSystems?: list<'android'|'ios'|'linux'|'macos'|'windows'|OperatingSystem>,
     *       screen?: array{
     *         maxHeight?: float, maxWidth?: float, minHeight?: float, minWidth?: float
     *       },
     *     },
     *     logSession?: bool,
     *     recordSession?: bool,
     *     solveCaptchas?: bool,
     *     viewport?: array{height?: float, width?: float},
     *   },
     *   extensionID?: string,
     *   keepAlive?: bool,
     *   projectID?: string,
     *   proxies?: bool|list<array<string,mixed>>,
     *   region?: 'us-west-2'|'us-east-1'|'eu-central-1'|'ap-southeast-1'|Region,
     *   timeout?: float,
     *   userMetadata?: array<string,mixed>,
     * } $browserbaseSessionCreateParams Body param:
     * @param string $browserbaseSessionID Body param: Existing Browserbase session ID to resume
     * @param float $domSettleTimeoutMs Body param: Timeout in ms to wait for DOM to settle
     * @param bool $experimental Body param:
     * @param bool $selfHeal Body param: Enable self-healing for failed actions
     * @param string $systemPrompt Body param: Custom system prompt for AI operations
     * @param float $verbose Body param: Logging verbosity level (0=quiet, 1=normal, 2=debug)
     * @param bool $waitForCaptchaSolves Body param: Wait for captcha solves (deprecated, v2 only)
     * @param 'typescript'|'python'|'playground'|\Stagehand\Sessions\SessionStartParams\XLanguage $xLanguage Header param: Client SDK language
     * @param string $xSDKVersion Header param: Version of the Stagehand SDK
     * @param string|\DateTimeInterface $xSentAt Header param: ISO timestamp when request was sent
     * @param 'true'|'false'|\Stagehand\Sessions\SessionStartParams\XStreamResponse $xStreamResponse Header param: Whether to stream the response via SSE
     *
     * @throws APIException
     */
    public function start(
        string $modelName,
        ?float $actTimeoutMs = null,
        ?array $browser = null,
        ?array $browserbaseSessionCreateParams = null,
        ?string $browserbaseSessionID = null,
        ?float $domSettleTimeoutMs = null,
        ?bool $experimental = null,
        ?bool $selfHeal = null,
        ?string $systemPrompt = null,
        ?float $verbose = null,
        ?bool $waitForCaptchaSolves = null,
        string|\Stagehand\Sessions\SessionStartParams\XLanguage|null $xLanguage = null,
        ?string $xSDKVersion = null,
        string|\DateTimeInterface|null $xSentAt = null,
        string|\Stagehand\Sessions\SessionStartParams\XStreamResponse|null $xStreamResponse = null,
        ?RequestOptions $requestOptions = null,
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
