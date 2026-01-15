<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions;

use StagehandSDK\Core\Attributes\Optional;
use StagehandSDK\Core\Concerns\SdkModel;
use StagehandSDK\Core\Concerns\SdkParams;
use StagehandSDK\Core\Contracts\BaseModel;
use StagehandSDK\Sessions\SessionEndParams\XStreamResponse;

/**
 * Terminates the browser session and releases all associated resources.
 *
 * @see StagehandSDK\Services\SessionsService::end()
 *
 * @phpstan-type SessionEndParamsShape = array{
 *   _forceBody?: mixed,
 *   xSentAt?: \DateTimeInterface|null,
 *   xStreamResponse?: null|XStreamResponse|value-of<XStreamResponse>,
 * }
 */
final class SessionEndParams implements BaseModel
{
    /** @use SdkModel<SessionEndParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public mixed $_forceBody;

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

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param XStreamResponse|value-of<XStreamResponse>|null $xStreamResponse
     */
    public static function with(
        mixed $_forceBody = null,
        ?\DateTimeInterface $xSentAt = null,
        XStreamResponse|string|null $xStreamResponse = null,
    ): self {
        $self = new self;

        null !== $_forceBody && $self['_forceBody'] = $_forceBody;
        null !== $xSentAt && $self['xSentAt'] = $xSentAt;
        null !== $xStreamResponse && $self['xStreamResponse'] = $xStreamResponse;

        return $self;
    }

    public function withForceBody(mixed $_forceBody): self
    {
        $self = clone $this;
        $self['_forceBody'] = $_forceBody;

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
