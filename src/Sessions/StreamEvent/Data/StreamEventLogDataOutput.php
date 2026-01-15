<?php

declare(strict_types=1);

namespace Stagehand\Sessions\StreamEvent\Data;

use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type StreamEventLogDataOutputShape = array{
 *   message: string, status: 'running'
 * }
 */
final class StreamEventLogDataOutput implements BaseModel
{
    /** @use SdkModel<StreamEventLogDataOutputShape> */
    use SdkModel;

    /** @var 'running' $status */
    #[Required]
    public string $status = 'running';

    /**
     * Log message from the operation.
     */
    #[Required]
    public string $message;

    /**
     * `new StreamEventLogDataOutput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StreamEventLogDataOutput::with(message: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StreamEventLogDataOutput)->withMessage(...)
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
     */
    public static function with(string $message): self
    {
        $self = new self;

        $self['message'] = $message;

        return $self;
    }

    /**
     * Log message from the operation.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
