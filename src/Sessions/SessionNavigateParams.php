<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions;

use StagehandSDK\Core\Attributes\Optional;
use StagehandSDK\Core\Attributes\Required;
use StagehandSDK\Core\Concerns\SdkModel;
use StagehandSDK\Core\Concerns\SdkParams;
use StagehandSDK\Core\Contracts\BaseModel;
use StagehandSDK\Sessions\SessionNavigateParams\Options;
use StagehandSDK\Sessions\SessionNavigateParams\XStreamResponse;

/**
 * Navigates the browser to the specified URL.
 *
 * @see StagehandSDK\Services\SessionsService::navigate()
 *
 * @phpstan-import-type OptionsShape from \StagehandSDK\Sessions\SessionNavigateParams\Options
 *
 * @phpstan-type SessionNavigateParamsShape = array{
 *   url: string,
 *   frameID?: string|null,
 *   options?: null|Options|OptionsShape,
 *   streamResponse?: bool|null,
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
     * Whether to stream the response via SSE.
     */
    #[Optional]
    public ?bool $streamResponse;

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
     * @param Options|OptionsShape|null $options
     * @param XStreamResponse|value-of<XStreamResponse>|null $xStreamResponse
     */
    public static function with(
        string $url,
        ?string $frameID = null,
        Options|array|null $options = null,
        ?bool $streamResponse = null,
        ?\DateTimeInterface $xSentAt = null,
        XStreamResponse|string|null $xStreamResponse = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $frameID && $self['frameID'] = $frameID;
        null !== $options && $self['options'] = $options;
        null !== $streamResponse && $self['streamResponse'] = $streamResponse;
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
     * @param Options|OptionsShape $options
     */
    public function withOptions(Options|array $options): self
    {
        $self = clone $this;
        $self['options'] = $options;

        return $self;
    }

    /**
     * Whether to stream the response via SSE.
     */
    public function withStreamResponse(bool $streamResponse): self
    {
        $self = clone $this;
        $self['streamResponse'] = $streamResponse;

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
