<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList;

use StagehandSDK\Core\Attributes\Optional;
use StagehandSDK\Core\Attributes\Required;
use StagehandSDK\Core\Concerns\SdkModel;
use StagehandSDK\Core\Contracts\BaseModel;
use StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList\BrowserbaseProxyConfig\Geolocation;

/**
 * @phpstan-import-type GeolocationShape from \StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList\BrowserbaseProxyConfig\Geolocation
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
     * @param Geolocation|GeolocationShape|null $geolocation
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
     * @param Geolocation|GeolocationShape $geolocation
     */
    public function withGeolocation(Geolocation|array $geolocation): self
    {
        $self = clone $this;
        $self['geolocation'] = $geolocation;

        return $self;
    }
}
