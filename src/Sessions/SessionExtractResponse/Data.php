<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExtractResponse;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{result: mixed, actionID?: string|null}
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Extracted data matching the requested schema.
     */
    #[Required]
    public mixed $result;

    /**
     * Action ID for tracking.
     */
    #[Optional('actionId')]
    public ?string $actionID;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(result: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withResult(...)
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
    public static function with(mixed $result, ?string $actionID = null): self
    {
        $self = new self;

        $self['result'] = $result;

        null !== $actionID && $self['actionID'] = $actionID;

        return $self;
    }

    /**
     * Extracted data matching the requested schema.
     */
    public function withResult(mixed $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }

    /**
     * Action ID for tracking.
     */
    public function withActionID(string $actionID): self
    {
        $self = clone $this;
        $self['actionID'] = $actionID;

        return $self;
    }
}
