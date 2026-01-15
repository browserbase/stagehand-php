<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\SessionNavigateResponse;

use StagehandSDK\Core\Attributes\Optional;
use StagehandSDK\Core\Attributes\Required;
use StagehandSDK\Core\Concerns\SdkModel;
use StagehandSDK\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{result: mixed, actionID?: string|null}
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Navigation response (Playwright Response object or null).
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
     * Navigation response (Playwright Response object or null).
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
