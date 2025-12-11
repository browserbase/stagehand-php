<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionNavigateParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionNavigateParams\Options\WaitUntil;

/**
 * @phpstan-type OptionsShape = array{waitUntil?: value-of<WaitUntil>|null}
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    /**
     * When to consider navigation complete.
     *
     * @var value-of<WaitUntil>|null $waitUntil
     */
    #[Optional(enum: WaitUntil::class)]
    public ?string $waitUntil;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param WaitUntil|value-of<WaitUntil> $waitUntil
     */
    public static function with(WaitUntil|string|null $waitUntil = null): self
    {
        $self = new self;

        null !== $waitUntil && $self['waitUntil'] = $waitUntil;

        return $self;
    }

    /**
     * When to consider navigation complete.
     *
     * @param WaitUntil|value-of<WaitUntil> $waitUntil
     */
    public function withWaitUntil(WaitUntil|string $waitUntil): self
    {
        $self = clone $this;
        $self['waitUntil'] = $waitUntil;

        return $self;
    }
}
