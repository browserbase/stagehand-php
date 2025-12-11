<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Concerns\SdkParams;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionExtractParams\Options;
use Stagehand\Sessions\SessionExtractParams\XStreamResponse;

/**
 * Extracts data from the current page using natural language instructions
 * and optional JSON schema for structured output.
 *
 * @see Stagehand\Services\SessionsService::extract()
 *
 * @phpstan-type SessionExtractParamsShape = array{
 *   frameID?: string,
 *   instruction?: string,
 *   options?: Options|array{
 *     model?: ModelConfig|null, selector?: string|null, timeout?: int|null
 *   },
 *   schema?: array<string,mixed>,
 *   xStreamResponse?: XStreamResponse|value-of<XStreamResponse>,
 * }
 */
final class SessionExtractParams implements BaseModel
{
    /** @use SdkModel<SessionExtractParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Frame ID to extract from.
     */
    #[Optional('frameId')]
    public ?string $frameID;

    /**
     * Natural language instruction for extraction.
     */
    #[Optional]
    public ?string $instruction;

    #[Optional]
    public ?Options $options;

    /**
     * JSON Schema for structured output.
     *
     * @var array<string,mixed>|null $schema
     */
    #[Optional(map: 'mixed')]
    public ?array $schema;

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
     * @param array<string,mixed> $schema
     * @param XStreamResponse|value-of<XStreamResponse> $xStreamResponse
     */
    public static function with(
        ?string $frameID = null,
        ?string $instruction = null,
        Options|array|null $options = null,
        ?array $schema = null,
        XStreamResponse|string|null $xStreamResponse = null,
    ): self {
        $self = new self;

        null !== $frameID && $self['frameID'] = $frameID;
        null !== $instruction && $self['instruction'] = $instruction;
        null !== $options && $self['options'] = $options;
        null !== $schema && $self['schema'] = $schema;
        null !== $xStreamResponse && $self['xStreamResponse'] = $xStreamResponse;

        return $self;
    }

    /**
     * Frame ID to extract from.
     */
    public function withFrameID(string $frameID): self
    {
        $self = clone $this;
        $self['frameID'] = $frameID;

        return $self;
    }

    /**
     * Natural language instruction for extraction.
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
     * JSON Schema for structured output.
     *
     * @param array<string,mixed> $schema
     */
    public function withSchema(array $schema): self
    {
        $self = clone $this;
        $self['schema'] = $schema;

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
