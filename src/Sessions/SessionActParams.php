<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions;

use StagehandSDK\Core\Attributes\Optional;
use StagehandSDK\Core\Attributes\Required;
use StagehandSDK\Core\Concerns\SdkModel;
use StagehandSDK\Core\Concerns\SdkParams;
use StagehandSDK\Core\Contracts\BaseModel;
use StagehandSDK\Sessions\SessionActParams\Options;
use StagehandSDK\Sessions\SessionActParams\XStreamResponse;

/**
 * Executes a browser action using natural language instructions or a predefined Action object.
 *
 * @see StagehandSDK\Services\SessionsService::act()
 *
 * @phpstan-import-type InputVariants from \StagehandSDK\Sessions\SessionActParams\Input
 * @phpstan-import-type InputShape from \StagehandSDK\Sessions\SessionActParams\Input
 * @phpstan-import-type OptionsShape from \StagehandSDK\Sessions\SessionActParams\Options
 *
 * @phpstan-type SessionActParamsShape = array{
 *   input: InputShape,
 *   frameID?: string|null,
 *   options?: null|Options|OptionsShape,
 *   xSentAt?: \DateTimeInterface|null,
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
    #[Optional('frameId')]
    public ?string $frameID;

    #[Optional]
    public ?Options $options;

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
        ?\DateTimeInterface $xSentAt = null,
        XStreamResponse|string|null $xStreamResponse = null,
    ): self {
        $self = new self;

        $self['input'] = $input;

        null !== $frameID && $self['frameID'] = $frameID;
        null !== $options && $self['options'] = $options;
        null !== $xSentAt && $self['xSentAt'] = $xSentAt;
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
