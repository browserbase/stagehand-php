<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * Navigation response (may be null).
 *
 * @phpstan-type SessionNavigateResponseShape = array{
 *   ok?: bool|null, status?: int|null, url?: string|null
 * }
 */
final class SessionNavigateResponse implements BaseModel
{
    /** @use SdkModel<SessionNavigateResponseShape> */
    use SdkModel;

    #[Optional]
    public ?bool $ok;

    #[Optional]
    public ?int $status;

    #[Optional]
    public ?string $url;

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
        ?bool $ok = null,
        ?int $status = null,
        ?string $url = null
    ): self {
        $self = new self;

        null !== $ok && $self['ok'] = $ok;
        null !== $status && $self['status'] = $status;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    public function withOk(bool $ok): self
    {
        $self = clone $this;
        $self['ok'] = $ok;

        return $self;
    }

    public function withStatus(int $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
