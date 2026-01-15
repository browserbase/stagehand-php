<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

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
