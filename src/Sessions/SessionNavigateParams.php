<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Concerns\SdkParams;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionNavigateParams\Options;
use Stagehand\Sessions\SessionNavigateParams\Options\WaitUntil;
use Stagehand\Sessions\SessionNavigateParams\XStreamResponse;

/**
 * Navigates the browser to the specified URL and waits for page load.
 *
 * @see Stagehand\Services\SessionsService::navigate()
 *
 * @phpstan-type SessionNavigateParamsShape = array{
 *   url: string,
 *   frameID?: string,
 *   options?: Options|array{waitUntil?: value-of<WaitUntil>|null},
 *   xStreamResponse?: XStreamResponse|value-of<XStreamResponse>,
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

    #[Optional('frameId')]
    public ?string $frameID;

    #[Optional]
    public ?Options $options;

    /** @var value-of<XStreamResponse>|null $xStreamResponse */
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
     * @param Options|array{waitUntil?: value-of<WaitUntil>|null} $options
     * @param XStreamResponse|value-of<XStreamResponse> $xStreamResponse
     */
    public static function with(
        string $url,
        ?string $frameID = null,
        Options|array|null $options = null,
        XStreamResponse|string|null $xStreamResponse = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $frameID && $self['frameID'] = $frameID;
        null !== $options && $self['options'] = $options;
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

    public function withFrameID(string $frameID): self
    {
        $self = clone $this;
        $self['frameID'] = $frameID;

        return $self;
    }

    /**
     * @param Options|array{waitUntil?: value-of<WaitUntil>|null} $options
     */
    public function withOptions(Options|array $options): self
    {
        $self = clone $this;
        $self['options'] = $options;

        return $self;
    }

    /**
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
