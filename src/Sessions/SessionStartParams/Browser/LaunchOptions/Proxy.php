<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\Browser\LaunchOptions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProxyShape = array{
 *   server: string,
 *   bypass?: string|null,
 *   password?: string|null,
 *   username?: string|null,
 * }
 */
final class Proxy implements BaseModel
{
    /** @use SdkModel<ProxyShape> */
    use SdkModel;

    #[Required]
    public string $server;

    #[Optional]
    public ?string $bypass;

    #[Optional]
    public ?string $password;

    #[Optional]
    public ?string $username;

    /**
     * `new Proxy()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Proxy::with(server: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Proxy)->withServer(...)
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
        string $server,
        ?string $bypass = null,
        ?string $password = null,
        ?string $username = null,
    ): self {
        $self = new self;

        $self['server'] = $server;

        null !== $bypass && $self['bypass'] = $bypass;
        null !== $password && $self['password'] = $password;
        null !== $username && $self['username'] = $username;

        return $self;
    }

    public function withServer(string $server): self
    {
        $self = clone $this;
        $self['server'] = $server;

        return $self;
    }

    public function withBypass(string $bypass): self
    {
        $self = clone $this;
        $self['bypass'] = $bypass;

        return $self;
    }

    public function withPassword(string $password): self
    {
        $self = clone $this;
        $self['password'] = $password;

        return $self;
    }

    public function withUsername(string $username): self
    {
        $self = clone $this;
        $self['username'] = $username;

        return $self;
    }
}
