<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions;

use StagehandSDK\Core\Attributes\Required;
use StagehandSDK\Core\Concerns\SdkModel;
use StagehandSDK\Core\Contracts\BaseModel;
use StagehandSDK\Sessions\StreamEvent\Data\StreamEventLogDataOutput;
use StagehandSDK\Sessions\StreamEvent\Data\StreamEventSystemDataOutput;
use StagehandSDK\Sessions\StreamEvent\Type;

/**
 * Server-Sent Event emitted during streaming responses. Events are sent as `data: <JSON>\n\n`. Key order: data (with status first), type, id.
 *
 * @phpstan-import-type DataVariants from \StagehandSDK\Sessions\StreamEvent\Data
 * @phpstan-import-type DataShape from \StagehandSDK\Sessions\StreamEvent\Data
 *
 * @phpstan-type StreamEventShape = array{
 *   id: string, data: DataShape, type: Type|value-of<Type>
 * }
 */
final class StreamEvent implements BaseModel
{
    /** @use SdkModel<StreamEventShape> */
    use SdkModel;

    /**
     * Unique identifier for this event.
     */
    #[Required]
    public string $id;

    /** @var DataVariants $data */
    #[Required]
    public StreamEventSystemDataOutput|StreamEventLogDataOutput $data;

    /**
     * Type of stream event - system events or log messages.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new StreamEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StreamEvent::with(id: ..., data: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StreamEvent)->withID(...)->withData(...)->withType(...)
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
     * @param DataShape $data
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        StreamEventSystemDataOutput|array|StreamEventLogDataOutput $data,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['data'] = $data;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Unique identifier for this event.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * @param DataShape $data
     */
    public function withData(
        StreamEventSystemDataOutput|array|StreamEventLogDataOutput $data
    ): self {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Type of stream event - system events or log messages.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
