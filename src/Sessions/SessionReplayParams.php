<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Concerns\SdkParams;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionReplayParams\XStreamResponse;

/**
 * Retrieves replay metrics for a session.
 *
 * @see Stagehand\Services\SessionsService::replay()
 *
 * @phpstan-type SessionReplayParamsShape = array{
 *   xStreamResponse?: null|XStreamResponse|value-of<XStreamResponse>
 * }
 */
final class SessionReplayParams implements BaseModel
{
    /** @use SdkModel<SessionReplayParamsShape> */
    use SdkModel;
    use SdkParams;

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
        XStreamResponse|string|null $xStreamResponse = null
    ): self {
        $self = new self;

        null !== $xStreamResponse && $self['xStreamResponse'] = $xStreamResponse;

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
