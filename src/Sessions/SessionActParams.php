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
 * Performs a browser action based on natural language instruction or
 * a specific action object returned by observe().
 *
 * @see Stagehand\Services\SessionsService::act()
 *
 * @phpstan-type SessionActParamsShape = array{
 *   input: string|Action|array{
 *     arguments: list<string>,
 *     description: string,
 *     method: string,
 *     selector: string,
 *     backendNodeID?: int|null,
 *   },
 *   frameID?: string,
 *   options?: Options|array{
 *     model?: ModelConfig|null,
 *     timeout?: int|null,
 *     variables?: array<string,string>|null,
 *   },
 *   xStreamResponse?: XStreamResponse|value-of<XStreamResponse>,
 * }
 */
final class SessionActParams implements BaseModel
{
    /** @use SdkModel<SessionActParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Natural language instruction.
     */
    #[Required]
    public string|Action $input;

    /**
     * Frame ID to act on (optional).
     */
    #[Optional('frameId')]
    public ?string $frameID;

    #[Optional]
    public ?Options $options;

    /** @var value-of<XStreamResponse>|null $xStreamResponse */
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
     * @param string|Action|array{
     *   arguments: list<string>,
     *   description: string,
     *   method: string,
     *   selector: string,
     *   backendNodeID?: int|null,
     * } $input
     * @param Options|array{
     *   model?: ModelConfig|null,
     *   timeout?: int|null,
     *   variables?: array<string,string>|null,
     * } $options
     * @param XStreamResponse|value-of<XStreamResponse> $xStreamResponse
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
     * Natural language instruction.
     *
     * @param string|Action|array{
     *   arguments: list<string>,
     *   description: string,
     *   method: string,
     *   selector: string,
     *   backendNodeID?: int|null,
     * } $input
     */
    public function withInput(string|Action|array $input): self
    {
        $self = clone $this;
        $self['input'] = $input;

        return $self;
    }

    /**
     * Frame ID to act on (optional).
     */
    public function withFrameID(string $frameID): self
    {
        $self = clone $this;
        $self['frameID'] = $frameID;

        return $self;
    }

    /**
     * @param Options|array{
     *   model?: ModelConfig|null,
     *   timeout?: int|null,
     *   variables?: array<string,string>|null,
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
