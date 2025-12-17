<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Concerns\SdkParams;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionNavigateParams\Options;
use Stagehand\Sessions\SessionNavigateParams\XLanguage;
use Stagehand\Sessions\SessionNavigateParams\XStreamResponse;

/**
 * Navigates the browser to the specified URL.
 *
 * @see Stagehand\Services\SessionsService::navigate()
 *
 * @phpstan-import-type OptionsShape from \Stagehand\Sessions\SessionNavigateParams\Options
 *
 * @phpstan-type SessionNavigateParamsShape = array{
 *   url: string,
 *   frameID?: string|null,
 *   options?: OptionsShape|null,
 *   xLanguage?: null|XLanguage|value-of<XLanguage>,
 *   xSDKVersion?: string|null,
 *   xSentAt?: \DateTimeInterface|null,
 *   xStreamResponse?: null|XStreamResponse|value-of<XStreamResponse>,
 * }
 */
final class SessionNavigateParams implements BaseModel
{
    /** @use SdkModel<SessionNavigateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * URL to navigate to.
     */
    #[Required]
    public string $url;

    /**
     * Target frame ID for the navigation.
     */
    #[Optional('frameId')]
    public ?string $frameID;

    #[Optional]
    public ?Options $options;

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
     * `new SessionNavigateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SessionNavigateParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SessionNavigateParams)->withURL(...)
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
     * @param OptionsShape $options
     * @param XLanguage|value-of<XLanguage> $xLanguage
     * @param XStreamResponse|value-of<XStreamResponse> $xStreamResponse
     */
    public static function with(
        string $url,
        ?string $frameID = null,
        Options|array|null $options = null,
        XLanguage|string|null $xLanguage = null,
        ?string $xSDKVersion = null,
        ?\DateTimeInterface $xSentAt = null,
        XStreamResponse|string|null $xStreamResponse = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $frameID && $self['frameID'] = $frameID;
        null !== $options && $self['options'] = $options;
        null !== $xLanguage && $self['xLanguage'] = $xLanguage;
        null !== $xSDKVersion && $self['xSDKVersion'] = $xSDKVersion;
        null !== $xSentAt && $self['xSentAt'] = $xSentAt;
        null !== $xStreamResponse && $self['xStreamResponse'] = $xStreamResponse;

        return $self;
    }

    /**
     * URL to navigate to.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Target frame ID for the navigation.
     */
    public function withFrameID(string $frameID): self
    {
        $self = clone $this;
        $self['frameID'] = $frameID;

        return $self;
    }

    /**
     * @param OptionsShape $options
     */
    public function withOptions(Options|array $options): self
    {
        $self = clone $this;
        $self['options'] = $options;

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
