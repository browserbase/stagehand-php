<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1\BrowserbaseProxyConfig\Geolocation;

/**
 * @phpstan-import-type GeolocationShape from \Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1\BrowserbaseProxyConfig\Geolocation
 *
 * @phpstan-type BrowserbaseProxyConfigShape = array{
 *   type: 'browserbase',
 *   domainPattern?: string|null,
 *   geolocation?: null|Geolocation|GeolocationShape,
 * }
 */
final class BrowserbaseProxyConfig implements BaseModel
{
    /** @use SdkModel<BrowserbaseProxyConfigShape> */
    use SdkModel;

    /** @var 'browserbase' $type */
    #[Required]
    public string $type = 'browserbase';

    #[Optional]
    public ?string $domainPattern;

    #[Optional]
    public ?Geolocation $geolocation;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param GeolocationShape $geolocation
     */
    public static function with(
        ?string $domainPattern = null,
        Geolocation|array|null $geolocation = null
    ): self {
        $self = new self;

        null !== $domainPattern && $self['domainPattern'] = $domainPattern;
        null !== $geolocation && $self['geolocation'] = $geolocation;

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
