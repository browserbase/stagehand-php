<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartResponse;

use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{
 *   available: bool, connectURL: string, sessionID: string
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    #[Required]
    public bool $available;

    /**
     * CDP WebSocket URL for connecting to the Browserbase cloud browser.
     */
    #[Required('connectUrl')]
    public string $connectURL;

    /**
     * Unique Browserbase session identifier.
     */
    #[Required('sessionId')]
    public string $sessionID;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(available: ..., connectURL: ..., sessionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withAvailable(...)->withConnectURL(...)->withSessionID(...)
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
        string $connectURL,
        string $sessionID
    ): self {
        $self = new self;

        $self['available'] = $available;
        $self['connectURL'] = $connectURL;
        $self['sessionID'] = $sessionID;

        return $self;
    }

    public function withAvailable(bool $available): self
    {
        $self = clone $this;
        $self['available'] = $available;

        return $self;
    }

    /**
     * CDP WebSocket URL for connecting to the Browserbase cloud browser.
     */
    public function withConnectURL(string $connectURL): self
    {
        $self = clone $this;
        $self['connectURL'] = $connectURL;

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
}
