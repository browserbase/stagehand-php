<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Concerns\SdkParams;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionStartParams\Browser;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams;
use Stagehand\Sessions\SessionStartParams\XLanguage;
use Stagehand\Sessions\SessionStartParams\XStreamResponse;

/**
 * Creates a new browser session with the specified configuration. Returns a session ID used for all subsequent operations.
 *
 * @see Stagehand\Services\SessionsService::start()
 *
 * @phpstan-import-type BrowserShape from \Stagehand\Sessions\SessionStartParams\Browser
 * @phpstan-import-type BrowserbaseSessionCreateParamsShape from \Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams
 *
 * @phpstan-type SessionStartParamsShape = array{
 *   modelName: string,
 *   actTimeoutMs?: float|null,
 *   browser?: BrowserShape|null,
 *   browserbaseSessionCreateParams?: BrowserbaseSessionCreateParamsShape|null,
 *   browserbaseSessionID?: string|null,
 *   debugDom?: bool|null,
 *   domSettleTimeoutMs?: float|null,
 *   experimental?: bool|null,
 *   selfHeal?: bool|null,
 *   systemPrompt?: string|null,
 *   verbose?: int|null,
 *   waitForCaptchaSolves?: bool|null,
 *   xLanguage?: null|XLanguage|value-of<XLanguage>,
 *   xSDKVersion?: string|null,
 *   xSentAt?: \DateTimeInterface|null,
 *   xStreamResponse?: null|XStreamResponse|value-of<XStreamResponse>,
 * }
 */
final class SessionStartParams implements BaseModel
{
    /** @use SdkModel<SessionStartParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Model name to use for AI operations.
     */
    #[Required]
    public string $modelName;

    /**
     * Timeout in ms for act operations.
     */
    #[Optional]
    public ?float $actTimeoutMs;

    #[Optional]
    public ?Browser $browser;

    #[Optional]
    public ?BrowserbaseSessionCreateParams $browserbaseSessionCreateParams;

    /**
     * Existing Browserbase session ID to resume.
     */
    #[Optional]
    public ?string $browserbaseSessionID;

    #[Optional]
    public ?bool $debugDom;

    /**
     * Timeout in ms to wait for DOM to settle.
     */
    #[Optional]
    public ?float $domSettleTimeoutMs;

    #[Optional]
    public ?bool $experimental;

    /**
     * Enable self-healing for failed actions.
     */
    #[Optional]
    public ?bool $selfHeal;

    /**
     * Custom system prompt for AI operations.
     */
    #[Optional]
    public ?string $systemPrompt;

    /**
     * Logging verbosity level (0=quiet, 1=normal, 2=debug).
     */
    #[Optional]
    public ?int $verbose;

    #[Optional]
    public ?bool $waitForCaptchaSolves;

    /**
     * Client SDK language.
     *
     * @var value-of<XLanguage>|null $xLanguage
     */
    #[Optional(enum: XLanguage::class)]
    public ?string $xLanguage;

    /**
     * Version of the Stagehand SDK.
     */
    #[Optional]
    public ?string $xSDKVersion;

    /**
     * ISO timestamp when request was sent.
     */
    #[Optional]
    public ?\DateTimeInterface $xSentAt;

    /**
     * Whether to stream the response via SSE.
     *
     * @var value-of<XStreamResponse>|null $xStreamResponse
     */
    #[Optional(enum: XStreamResponse::class)]
    public ?string $xStreamResponse;

    /**
     * `new SessionStartParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SessionStartParams::with(modelName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SessionStartParams)->withModelName(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param BrowserShape $browser
     * @param BrowserbaseSessionCreateParamsShape $browserbaseSessionCreateParams
     * @param XLanguage|value-of<XLanguage> $xLanguage
     * @param XStreamResponse|value-of<XStreamResponse> $xStreamResponse
     */
    public static function with(
        string $modelName,
        ?float $actTimeoutMs = null,
        Browser|array|null $browser = null,
        BrowserbaseSessionCreateParams|array|null $browserbaseSessionCreateParams = null,
        ?string $browserbaseSessionID = null,
        ?bool $debugDom = null,
        ?float $domSettleTimeoutMs = null,
        ?bool $experimental = null,
        ?bool $selfHeal = null,
        ?string $systemPrompt = null,
        ?int $verbose = null,
        ?bool $waitForCaptchaSolves = null,
        XLanguage|string|null $xLanguage = null,
        ?string $xSDKVersion = null,
        ?\DateTimeInterface $xSentAt = null,
        XStreamResponse|string|null $xStreamResponse = null,
    ): self {
        $self = new self;

        $self['modelName'] = $modelName;

        null !== $actTimeoutMs && $self['actTimeoutMs'] = $actTimeoutMs;
        null !== $browser && $self['browser'] = $browser;
        null !== $browserbaseSessionCreateParams && $self['browserbaseSessionCreateParams'] = $browserbaseSessionCreateParams;
        null !== $browserbaseSessionID && $self['browserbaseSessionID'] = $browserbaseSessionID;
        null !== $debugDom && $self['debugDom'] = $debugDom;
        null !== $domSettleTimeoutMs && $self['domSettleTimeoutMs'] = $domSettleTimeoutMs;
        null !== $experimental && $self['experimental'] = $experimental;
        null !== $selfHeal && $self['selfHeal'] = $selfHeal;
        null !== $systemPrompt && $self['systemPrompt'] = $systemPrompt;
        null !== $verbose && $self['verbose'] = $verbose;
        null !== $waitForCaptchaSolves && $self['waitForCaptchaSolves'] = $waitForCaptchaSolves;
        null !== $xLanguage && $self['xLanguage'] = $xLanguage;
        null !== $xSDKVersion && $self['xSDKVersion'] = $xSDKVersion;
        null !== $xSentAt && $self['xSentAt'] = $xSentAt;
        null !== $xStreamResponse && $self['xStreamResponse'] = $xStreamResponse;

        return $self;
    }

    /**
     * Model name to use for AI operations.
     */
    public function withModelName(string $modelName): self
    {
        $self = clone $this;
        $self['modelName'] = $modelName;

        return $self;
    }

    /**
     * Timeout in ms for act operations.
     */
    public function withActTimeoutMs(float $actTimeoutMs): self
    {
        $self = clone $this;
        $self['actTimeoutMs'] = $actTimeoutMs;

        return $self;
    }

    /**
     * @param BrowserShape $browser
     */
    public function withBrowser(Browser|array $browser): self
    {
        $self = clone $this;
        $self['browser'] = $browser;

        return $self;
    }

    /**
     * @param BrowserbaseSessionCreateParamsShape $browserbaseSessionCreateParams
     */
    public function withBrowserbaseSessionCreateParams(
        BrowserbaseSessionCreateParams|array $browserbaseSessionCreateParams
    ): self {
        $self = clone $this;
        $self['browserbaseSessionCreateParams'] = $browserbaseSessionCreateParams;

        return $self;
    }

    /**
     * Existing Browserbase session ID to resume.
     */
    public function withBrowserbaseSessionID(string $browserbaseSessionID): self
    {
        $self = clone $this;
        $self['browserbaseSessionID'] = $browserbaseSessionID;

        return $self;
    }

    public function withDebugDom(bool $debugDom): self
    {
        $self = clone $this;
        $self['debugDom'] = $debugDom;

        return $self;
    }

    /**
     * Timeout in ms to wait for DOM to settle.
     */
    public function withDomSettleTimeoutMs(float $domSettleTimeoutMs): self
    {
        $self = clone $this;
        $self['domSettleTimeoutMs'] = $domSettleTimeoutMs;

        return $self;
    }

    public function withExperimental(bool $experimental): self
    {
        $self = clone $this;
        $self['experimental'] = $experimental;

        return $self;
    }

    /**
     * Enable self-healing for failed actions.
     */
    public function withSelfHeal(bool $selfHeal): self
    {
        $self = clone $this;
        $self['selfHeal'] = $selfHeal;

        return $self;
    }

    /**
     * Custom system prompt for AI operations.
     */
    public function withSystemPrompt(string $systemPrompt): self
    {
        $self = clone $this;
        $self['systemPrompt'] = $systemPrompt;

        return $self;
    }

    /**
     * Logging verbosity level (0=quiet, 1=normal, 2=debug).
     */
    public function withVerbose(int $verbose): self
    {
        $self = clone $this;
        $self['verbose'] = $verbose;

        return $self;
    }

    public function withWaitForCaptchaSolves(bool $waitForCaptchaSolves): self
    {
        $self = clone $this;
        $self['waitForCaptchaSolves'] = $waitForCaptchaSolves;

        return $self;
    }

    /**
     * Client SDK language.
     *
     * @param XLanguage|value-of<XLanguage> $xLanguage
     */
    public function withXLanguage(XLanguage|string $xLanguage): self
    {
        $self = clone $this;
        $self['xLanguage'] = $xLanguage;

        return $self;
    }

    /**
     * Version of the Stagehand SDK.
     */
    public function withXSDKVersion(string $xSDKVersion): self
    {
        $self = clone $this;
        $self['xSDKVersion'] = $xSDKVersion;

        return $self;
    }

    /**
     * ISO timestamp when request was sent.
     */
    public function withXSentAt(\DateTimeInterface $xSentAt): self
    {
        $self = clone $this;
        $self['xSentAt'] = $xSentAt;

        return $self;
    }

    /**
     * Whether to stream the response via SSE.
     *
     * @param XStreamResponse|value-of<XStreamResponse> $xStreamResponse
     */
    public function withXStreamResponse(
        XStreamResponse|string $xStreamResponse
    ): self {
        $self = clone $this;
        $self['xStreamResponse'] = $xStreamResponse;

        return $self;
    }
}
