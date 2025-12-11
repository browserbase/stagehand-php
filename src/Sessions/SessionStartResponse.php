<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type SessionStartResponseShape = array{
 *   available: bool, sessionID: string
 * }
 */
final class SessionStartResponse implements BaseModel
{
    /** @use SdkModel<SessionStartResponseShape> */
    use SdkModel;

    /**
     * Whether the session is ready to use.
     */
    #[Required]
    public bool $available;

    /**
     * Unique identifier for the session.
     */
    #[Required('sessionId')]
    public string $sessionID;

    /**
     * `new SessionStartResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SessionStartResponse::with(available: ..., sessionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SessionStartResponse)->withAvailable(...)->withSessionID(...)
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
    public static function with(bool $available, string $sessionID): self
    {
        $self = new self;

        $self['available'] = $available;
        $self['sessionID'] = $sessionID;

        return $self;
    }

    /**
     * Whether the session is ready to use.
     */
    public function withAvailable(bool $available): self
    {
        $self = clone $this;
        $self['available'] = $available;

        return $self;
    }

    /**
     * Unique identifier for the session.
     */
    public function withSessionID(string $sessionID): self
    {
        $self = clone $this;
        $self['sessionID'] = $sessionID;

        return $self;
    }
}
