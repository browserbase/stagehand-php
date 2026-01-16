<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Concerns\SdkParams;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionObserveParams\Options;
use Stagehand\Sessions\SessionObserveParams\XStreamResponse;

/**
 * Identifies and returns available actions on the current page that match the given instruction.
 *
 * @see Stagehand\Services\SessionsService::observe()
 *
 * @phpstan-import-type OptionsShape from \Stagehand\Sessions\SessionObserveParams\Options
 *
 * @phpstan-type SessionObserveParamsShape = array{
 *   frameID?: string|null,
 *   instruction?: string|null,
 *   options?: null|Options|OptionsShape,
 *   xStreamResponse?: null|XStreamResponse|value-of<XStreamResponse>,
 * }
 */
final class SessionObserveParams implements BaseModel
{
    /** @use SdkModel<SessionObserveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Target frame ID for the observation.
     */
    #[Optional('frameId', nullable: true)]
    public ?string $frameID;

    /**
     * Natural language instruction for what actions to find.
     */
    #[Optional]
    public ?string $instruction;

    #[Optional]
    public ?Options $options;

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
     * @param Options|OptionsShape|null $options
     * @param XStreamResponse|value-of<XStreamResponse>|null $xStreamResponse
     */
    public static function with(
        ?string $frameID = null,
        ?string $instruction = null,
        Options|array|null $options = null,
        XStreamResponse|string|null $xStreamResponse = null,
    ): self {
        $self = new self;

        null !== $frameID && $self['frameID'] = $frameID;
        null !== $instruction && $self['instruction'] = $instruction;
        null !== $options && $self['options'] = $options;
        null !== $xStreamResponse && $self['xStreamResponse'] = $xStreamResponse;

        return $self;
    }

    /**
     * Target frame ID for the observation.
     */
    public function withFrameID(?string $frameID): self
    {
        $self = clone $this;
        $self['frameID'] = $frameID;

        return $self;
    }

    /**
     * Natural language instruction for what actions to find.
     */
    public function withInstruction(string $instruction): self
    {
        $self = clone $this;
        $self['instruction'] = $instruction;

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
