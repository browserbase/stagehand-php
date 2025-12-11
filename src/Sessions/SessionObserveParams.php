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
 * Returns a list of candidate actions that can be performed on the page,
 * optionally filtered by natural language instruction.
 *
 * @see Stagehand\Services\SessionsService::observe()
 *
 * @phpstan-type SessionObserveParamsShape = array{
 *   frameID?: string,
 *   instruction?: string,
 *   options?: Options|array{
 *     model?: ModelConfig|null, selector?: string|null, timeout?: int|null
 *   },
 *   xStreamResponse?: XStreamResponse|value-of<XStreamResponse>,
 * }
 */
final class SessionObserveParams implements BaseModel
{
    /** @use SdkModel<SessionObserveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Frame ID to observe.
     */
    #[Optional('frameId')]
    public ?string $frameID;

    /**
     * Natural language instruction to filter actions.
     */
    #[Optional]
    public ?string $instruction;

    #[Optional]
    public ?Options $options;

    /** @var value-of<XStreamResponse>|null $xStreamResponse */
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
     * @param Options|array{
     *   model?: ModelConfig|null, selector?: string|null, timeout?: int|null
     * } $options
     * @param XStreamResponse|value-of<XStreamResponse> $xStreamResponse
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
     * Frame ID to observe.
     */
    public function withFrameID(string $frameID): self
    {
        $self = clone $this;
        $self['frameID'] = $frameID;

        return $self;
    }

    /**
     * Natural language instruction to filter actions.
     */
    public function withInstruction(string $instruction): self
    {
        $self = clone $this;
        $self['instruction'] = $instruction;

        return $self;
    }

    /**
     * @param Options|array{
     *   model?: ModelConfig|null, selector?: string|null, timeout?: int|null
     * } $options
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
