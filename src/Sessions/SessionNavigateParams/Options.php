<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\SessionNavigateParams;

use StagehandSDK\Core\Attributes\Optional;
use StagehandSDK\Core\Concerns\SdkModel;
use StagehandSDK\Core\Contracts\BaseModel;
use StagehandSDK\Sessions\SessionNavigateParams\Options\WaitUntil;

/**
 * @phpstan-type OptionsShape = array{
 *   referer?: string|null,
 *   timeout?: float|null,
 *   waitUntil?: null|WaitUntil|value-of<WaitUntil>,
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    /**
     * Referer header to send with the request.
     */
    #[Optional]
    public ?string $referer;

    /**
     * Timeout in ms for the navigation.
     */
    #[Optional]
    public ?float $timeout;

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
     * @param WaitUntil|value-of<WaitUntil>|null $waitUntil
     */
    public static function with(
        ?string $referer = null,
        ?float $timeout = null,
        WaitUntil|string|null $waitUntil = null,
    ): self {
        $self = new self;

        null !== $referer && $self['referer'] = $referer;
        null !== $timeout && $self['timeout'] = $timeout;
        null !== $waitUntil && $self['waitUntil'] = $waitUntil;

        return $self;
    }

    /**
     * Referer header to send with the request.
     */
    public function withReferer(string $referer): self
    {
        $self = clone $this;
        $self['referer'] = $referer;

        return $self;
    }

    /**
     * Timeout in ms for the navigation.
     */
    public function withTimeout(float $timeout): self
    {
        $self = clone $this;
        $self['timeout'] = $timeout;

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
