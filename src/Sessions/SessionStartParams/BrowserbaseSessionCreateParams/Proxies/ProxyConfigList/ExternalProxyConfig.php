<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type ExternalProxyConfigShape = array{
 *   server: string,
 *   type: 'external',
 *   domainPattern?: string|null,
 *   password?: string|null,
 *   username?: string|null,
 * }
 */
final class ExternalProxyConfig implements BaseModel
{
    /** @use SdkModel<ExternalProxyConfigShape> */
    use SdkModel;

    /** @var 'external' $type */
    #[Required]
    public string $type = 'external';

    #[Required]
    public string $server;

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
     * ExternalProxyConfig::with(server: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExternalProxyConfig)->withServer(...)
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
        ?string $domainPattern = null,
        ?string $password = null,
        ?string $username = null,
    ): self {
        $self = new self;

        $self['server'] = $server;

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
