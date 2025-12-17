<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1\ExternalProxyConfig\Type;

/**
 * @phpstan-type ExternalProxyConfigShape = array{
 *   server: string,
 *   type: Type|value-of<Type>,
 *   domainPattern?: string|null,
 *   password?: string|null,
 *   username?: string|null,
 * }
 */
final class ExternalProxyConfig implements BaseModel
{
    /** @use SdkModel<ExternalProxyConfigShape> */
    use SdkModel;

    #[Required]
    public string $server;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional]
    public ?string $domainPattern;

    #[Optional]
    public ?string $password;

    #[Optional]
    public ?string $username;

    /**
     * `new ExternalProxyConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExternalProxyConfig::with(server: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExternalProxyConfig)->withServer(...)->withType(...)
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
     *
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $server,
        Type|string $type,
        ?string $domainPattern = null,
        ?string $password = null,
        ?string $username = null,
    ): self {
        $self = new self;

        $self['server'] = $server;
        $self['type'] = $type;

        null !== $domainPattern && $self['domainPattern'] = $domainPattern;
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

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withDomainPattern(string $domainPattern): self
    {
        $self = clone $this;
        $self['domainPattern'] = $domainPattern;

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
