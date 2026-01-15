<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\StreamEvent\Data;

use StagehandSDK\Core\Attributes\Optional;
use StagehandSDK\Core\Attributes\Required;
use StagehandSDK\Core\Concerns\SdkModel;
use StagehandSDK\Core\Contracts\BaseModel;
use StagehandSDK\Sessions\StreamEvent\Data\StreamEventSystemDataOutput\Status;

/**
 * @phpstan-type StreamEventSystemDataOutputShape = array{
 *   status: Status|value-of<Status>, error?: string|null, result?: mixed
 * }
 */
final class StreamEventSystemDataOutput implements BaseModel
{
    /** @use SdkModel<StreamEventSystemDataOutputShape> */
    use SdkModel;

    /**
     * Current status of the streaming operation.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Error message (present when status is 'error').
     */
    #[Optional]
    public ?string $error;

    /**
     * Operation result (present when status is 'finished').
     */
    #[Optional]
    public mixed $result;

    /**
     * `new StreamEventSystemDataOutput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StreamEventSystemDataOutput::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StreamEventSystemDataOutput)->withStatus(...)
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
     * @param Status|value-of<Status> $status
     */
    public static function with(
        Status|string $status,
        ?string $error = null,
        mixed $result = null
    ): self {
        $self = new self;

        $self['status'] = $status;

        null !== $error && $self['error'] = $error;
        null !== $result && $self['result'] = $result;

        return $self;
    }

    /**
     * Current status of the streaming operation.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Error message (present when status is 'error').
     */
    public function withError(string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Operation result (present when status is 'finished').
     */
    public function withResult(mixed $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }
}
