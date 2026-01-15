<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings;

use StagehandSDK\Core\Attributes\Optional;
use StagehandSDK\Core\Attributes\Required;
use StagehandSDK\Core\Concerns\SdkModel;
use StagehandSDK\Core\Contracts\BaseModel;

/**
 * @phpstan-type ContextShape = array{id: string, persist?: bool|null}
 */
final class Context implements BaseModel
{
    /** @use SdkModel<ContextShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Optional]
    public ?bool $persist;

    /**
     * `new Context()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Context::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Context)->withID(...)
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
    public static function with(string $id, ?bool $persist = null): self
    {
        $self = new self;

        $self['id'] = $id;

        null !== $persist && $self['persist'] = $persist;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withPersist(bool $persist): self
    {
        $self = clone $this;
        $self['persist'] = $persist;

        return $self;
    }
}
