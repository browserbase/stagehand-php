<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartResponse;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{
 *   available: bool, sessionID: string, cdpURL?: string|null
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    #[Required]
    public bool $available;

    /**
     * Unique Browserbase session identifier.
     */
    #[Required('sessionId')]
    public string $sessionID;

    /**
     * CDP WebSocket URL for connecting to the Browserbase cloud browser (present when available).
     */
    #[Optional('cdpUrl', nullable: true)]
    public ?string $cdpURL;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(available: ..., sessionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withAvailable(...)->withSessionID(...)
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
    public static function with(
        bool $available,
        string $sessionID,
        ?string $cdpURL = null
    ): self {
        $self = new self;

        $self['available'] = $available;
        $self['sessionID'] = $sessionID;

        null !== $cdpURL && $self['cdpURL'] = $cdpURL;

        return $self;
    }

    public function withAvailable(bool $available): self
    {
        $self = clone $this;
        $self['available'] = $available;

        return $self;
    }

    /**
     * Unique Browserbase session identifier.
     */
    public function withSessionID(string $sessionID): self
    {
        $self = clone $this;
        $self['sessionID'] = $sessionID;

        return $self;
    }

    /**
     * CDP WebSocket URL for connecting to the Browserbase cloud browser (present when available).
     */
    public function withCdpURL(?string $cdpURL): self
    {
        $self = clone $this;
        $self['cdpURL'] = $cdpURL;

        return $self;
    }
}
