<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Concerns\SdkParams;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionActParams\Options;
use Stagehand\Sessions\SessionActParams\XStreamResponse;

/**
 * Executes a browser action using natural language instructions or a predefined Action object.
 *
 * @see Stagehand\Services\SessionsService::act()
 *
 * @phpstan-import-type InputVariants from \Stagehand\Sessions\SessionActParams\Input
 * @phpstan-import-type InputShape from \Stagehand\Sessions\SessionActParams\Input
 * @phpstan-import-type OptionsShape from \Stagehand\Sessions\SessionActParams\Options
 *
 * @phpstan-type SessionActParamsShape = array{
 *   input: InputShape,
 *   frameID?: string|null,
 *   options?: null|Options|OptionsShape,
 *   xStreamResponse?: null|XStreamResponse|value-of<XStreamResponse>,
 * }
 */
final class SessionActParams implements BaseModel
{
    /** @use SdkModel<SessionActParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Natural language instruction or Action object.
     *
     * @var InputVariants $input
     */
    #[Required]
    public string|Action $input;

    /**
     * Target frame ID for the action.
     */
    #[Optional('frameId', nullable: true)]
    public ?string $frameID;

    #[Optional]
    public ?Options $options;

    /**
     * Whether to stream the response via SSE.
     *
     * @var value-of<XStreamResponse>|null $xStreamResponse
     */
    #[Optional(enum: XStreamResponse::class)]
    public ?string $xStreamResponse;

    /**
     * `new SessionActParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SessionActParams::with(input: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SessionActParams)->withInput(...)
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
     * @param InputShape $input
     * @param Options|OptionsShape|null $options
     * @param XStreamResponse|value-of<XStreamResponse>|null $xStreamResponse
     */
    public static function with(
        string|Action|array $input,
        ?string $frameID = null,
        Options|array|null $options = null,
        XStreamResponse|string|null $xStreamResponse = null,
    ): self {
        $self = new self;

        $self['input'] = $input;

        null !== $frameID && $self['frameID'] = $frameID;
        null !== $options && $self['options'] = $options;
        null !== $xStreamResponse && $self['xStreamResponse'] = $xStreamResponse;

        return $self;
    }

    /**
     * Natural language instruction or Action object.
     *
     * @param InputShape $input
     */
    public function withInput(string|Action|array $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

        return $self;
    }

    /**
     * Target frame ID for the action.
     */
    public function withFrameID(?string $frameID): self
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
