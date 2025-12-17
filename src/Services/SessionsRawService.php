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
use Stagehand\Sessions\SessionActParams\XLanguage;
use Stagehand\Sessions\SessionActParams\XStreamResponse;
use Stagehand\Sessions\SessionActResponse;
use Stagehand\Sessions\SessionEndParams;
use Stagehand\Sessions\SessionEndResponse;
use Stagehand\Sessions\SessionExecuteParams;
use Stagehand\Sessions\SessionExecuteResponse;
use Stagehand\Sessions\SessionExtractParams;
use Stagehand\Sessions\SessionExtractResponse;
use Stagehand\Sessions\SessionNavigateParams;
use Stagehand\Sessions\SessionNavigateParams\Options\WaitUntil;
use Stagehand\Sessions\SessionNavigateResponse;
use Stagehand\Sessions\SessionObserveParams;
use Stagehand\Sessions\SessionObserveResponse;
use Stagehand\Sessions\SessionStartParams;
use Stagehand\Sessions\SessionStartParams\Browser\Type;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint\HTTPVersion;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Region;
use Stagehand\Sessions\SessionStartParams\Verbose;
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
     * Executes a browser action using natural language instructions or a predefined Action object.
     *
     * @param string $id Path param: Unique session identifier
     * @param array{
     *   input: string|array{
     *     description: string,
     *     selector: string,
     *     arguments?: list<string>,
     *     method?: string,
     *   },
     *   frameID?: string,
     *   options?: array{
     *     model?: string|array{modelName: string, apiKey?: string, baseURL?: string},
     *     timeout?: float,
     *     variables?: array<string,string>,
     *   },
     *   xLanguage?: 'typescript'|'python'|'playground'|XLanguage,
     *   xSDKVersion?: string,
     *   xSentAt?: string|\DateTimeInterface,
     *   xStreamResponse?: 'true'|'false'|XStreamResponse,
     * }|SessionActParams $params
     *
     * @return BaseResponse<SessionActResponse>
     *
     * @throws APIException
     */
    public function act(
        string $id,
        array|SessionActParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionActParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'xLanguage' => 'x-language',
            'xSDKVersion' => 'x-sdk-version',
            'xSentAt' => 'x-sent-at',
            'xStreamResponse' => 'x-stream-response',
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
     * Terminates the browser session and releases all associated resources.
     *
     * @param string $id Unique session identifier
     * @param array{
     *   xLanguage?: 'typescript'|'python'|'playground'|SessionEndParams\XLanguage,
     *   xSDKVersion?: string,
     *   xSentAt?: string|\DateTimeInterface,
     *   xStreamResponse?: 'true'|'false'|SessionEndParams\XStreamResponse,
     * }|SessionEndParams $params
     *
     * @return BaseResponse<SessionEndResponse>
     *
     * @throws APIException
     */
    public function end(
        string $id,
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
            path: ['v1/sessions/%1$s/end', $id],
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
     *   agentConfig: array{
     *     cua?: bool,
     *     model?: string|array{modelName: string, apiKey?: string, baseURL?: string},
     *     systemPrompt?: string,
     *   },
     *   executeOptions: array{
     *     instruction: string, highlightCursor?: bool, maxSteps?: float
     *   },
     *   frameID?: string,
     *   xLanguage?: 'typescript'|'python'|'playground'|SessionExecuteParams\XLanguage,
     *   xSDKVersion?: string,
     *   xSentAt?: string|\DateTimeInterface,
     *   xStreamResponse?: 'true'|'false'|SessionExecuteParams\XStreamResponse,
     * }|SessionExecuteParams $params
     *
     * @return BaseResponse<SessionExecuteResponse>
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        array|SessionExecuteParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionExecuteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'xLanguage' => 'x-language',
            'xSDKVersion' => 'x-sdk-version',
            'xSentAt' => 'x-sent-at',
            'xStreamResponse' => 'x-stream-response',
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
     * Extracts structured data from the current page using AI-powered analysis.
     *
     * @param string $id Path param: Unique session identifier
     * @param array{
     *   frameID?: string,
     *   instruction?: string,
     *   options?: array{
     *     model?: string|array{modelName: string, apiKey?: string, baseURL?: string},
     *     selector?: string,
     *     timeout?: float,
     *   },
     *   schema?: array<string,mixed>,
     *   xLanguage?: 'typescript'|'python'|'playground'|SessionExtractParams\XLanguage,
     *   xSDKVersion?: string,
     *   xSentAt?: string|\DateTimeInterface,
     *   xStreamResponse?: 'true'|'false'|SessionExtractParams\XStreamResponse,
     * }|SessionExtractParams $params
     *
     * @return BaseResponse<SessionExtractResponse>
     *
     * @throws APIException
     */
    public function extract(
        string $id,
        array|SessionExtractParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionExtractParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'xLanguage' => 'x-language',
            'xSDKVersion' => 'x-sdk-version',
            'xSentAt' => 'x-sent-at',
            'xStreamResponse' => 'x-stream-response',
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
     * Navigates the browser to the specified URL.
     *
     * @param string $id Path param: Unique session identifier
     * @param array{
     *   url: string,
     *   frameID?: string,
     *   options?: array{
     *     referer?: string,
     *     timeout?: float,
     *     waitUntil?: 'load'|'domcontentloaded'|'networkidle'|WaitUntil,
     *   },
     *   xLanguage?: 'typescript'|'python'|'playground'|SessionNavigateParams\XLanguage,
     *   xSDKVersion?: string,
     *   xSentAt?: string|\DateTimeInterface,
     *   xStreamResponse?: 'true'|'false'|SessionNavigateParams\XStreamResponse,
     * }|SessionNavigateParams $params
     *
     * @return BaseResponse<SessionNavigateResponse>
     *
     * @throws APIException
     */
    public function navigate(
        string $id,
        array|SessionNavigateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionNavigateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'xLanguage' => 'x-language',
            'xSDKVersion' => 'x-sdk-version',
            'xSentAt' => 'x-sent-at',
            'xStreamResponse' => 'x-stream-response',
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
     *   options?: array{
     *     model?: string|array{modelName: string, apiKey?: string, baseURL?: string},
     *     selector?: string,
     *     timeout?: float,
     *   },
     *   xLanguage?: 'typescript'|'python'|'playground'|SessionObserveParams\XLanguage,
     *   xSDKVersion?: string,
     *   xSentAt?: string|\DateTimeInterface,
     *   xStreamResponse?: 'true'|'false'|SessionObserveParams\XStreamResponse,
     * }|SessionObserveParams $params
     *
     * @return BaseResponse<SessionObserveResponse>
     *
     * @throws APIException
     */
    public function observe(
        string $id,
        array|SessionObserveParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = SessionObserveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'xLanguage' => 'x-language',
            'xSDKVersion' => 'x-sdk-version',
            'xSentAt' => 'x-sent-at',
            'xStreamResponse' => 'x-stream-response',
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
     * Creates a new browser session with the specified configuration. Returns a session ID used for all subsequent operations.
     *
     * @param array{
     *   modelName: string,
     *   actTimeoutMs?: float,
     *   browser?: array{
     *     cdpURL?: string,
     *     launchOptions?: array{
     *       acceptDownloads?: bool,
     *       args?: list<string>,
     *       cdpURL?: string,
     *       chromiumSandbox?: bool,
     *       connectTimeoutMs?: float,
     *       deviceScaleFactor?: float,
     *       devtools?: bool,
     *       downloadsPath?: string,
     *       executablePath?: string,
     *       hasTouch?: bool,
     *       headless?: bool,
     *       ignoreDefaultArgs?: bool|list<string>,
     *       ignoreHTTPSErrors?: bool,
     *       locale?: string,
     *       preserveUserDataDir?: bool,
     *       proxy?: array{
     *         server: string, bypass?: string, password?: string, username?: string
     *       },
     *       userDataDir?: string,
     *       viewport?: array{height: float, width: float},
     *     },
     *     type?: 'local'|'browserbase'|Type,
     *   },
     *   browserbaseSessionCreateParams?: array{
     *     browserSettings?: array{
     *       advancedStealth?: bool,
     *       blockAds?: bool,
     *       context?: array{id: string, persist?: bool},
     *       extensionID?: string,
     *       fingerprint?: array{
     *         browsers?: list<mixed>,
     *         devices?: list<mixed>,
     *         httpVersion?: '1'|'2'|HTTPVersion,
     *         locales?: list<string>,
     *         operatingSystems?: list<mixed>,
     *         screen?: array<string,mixed>,
     *       },
     *       logSession?: bool,
     *       recordSession?: bool,
     *       solveCaptchas?: bool,
     *       viewport?: array{height?: float, width?: float},
     *     },
     *     extensionID?: string,
     *     keepAlive?: bool,
     *     projectID?: string,
     *     proxies?: bool|list<array<string,mixed>>,
     *     region?: 'us-west-2'|'us-east-1'|'eu-central-1'|'ap-southeast-1'|Region,
     *     timeout?: float,
     *     userMetadata?: array<string,mixed>,
     *   },
     *   browserbaseSessionID?: string,
     *   debugDom?: bool,
     *   domSettleTimeoutMs?: float,
     *   experimental?: bool,
     *   selfHeal?: bool,
     *   systemPrompt?: string,
     *   verbose?: 0|1|2|Verbose,
     *   waitForCaptchaSolves?: bool,
     *   xLanguage?: 'typescript'|'python'|'playground'|SessionStartParams\XLanguage,
     *   xSDKVersion?: string,
     *   xSentAt?: string|\DateTimeInterface,
     *   xStreamResponse?: 'true'|'false'|SessionStartParams\XStreamResponse,
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
        $header_params = [
            'xLanguage' => 'x-language',
            'xSDKVersion' => 'x-sdk-version',
            'xSentAt' => 'x-sent-at',
            'xStreamResponse' => 'x-stream-response',
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
