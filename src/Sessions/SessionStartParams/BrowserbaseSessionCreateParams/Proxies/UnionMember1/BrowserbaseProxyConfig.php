<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1\BrowserbaseProxyConfig\Geolocation;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1\BrowserbaseProxyConfig\Type;

/**
 * @phpstan-import-type GeolocationShape from \Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1\BrowserbaseProxyConfig\Geolocation
 *
 * @phpstan-type BrowserbaseProxyConfigShape = array{
 *   type: Type|value-of<Type>,
 *   domainPattern?: string|null,
 *   geolocation?: null|Geolocation|GeolocationShape,
 * }
 */
final class BrowserbaseProxyConfig implements BaseModel
{
    /** @use SdkModel<BrowserbaseProxyConfigShape> */
    use SdkModel;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional]
    public ?string $domainPattern;

    #[Optional]
    public ?Geolocation $geolocation;

    /**
     * `new BrowserbaseProxyConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrowserbaseProxyConfig::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrowserbaseProxyConfig)->withType(...)
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
     * @param GeolocationShape $geolocation
     */
    public static function with(
        Type|string $type,
        ?string $domainPattern = null,
        Geolocation|array|null $geolocation = null,
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $domainPattern && $self['domainPattern'] = $domainPattern;
        null !== $geolocation && $self['geolocation'] = $geolocation;

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

    /**
     * @param GeolocationShape $geolocation
     */
    public function withGeolocation(Geolocation|array $geolocation): self
    {
        $self = clone $this;
        $self['geolocation'] = $geolocation;

        return $self;
    }
}
