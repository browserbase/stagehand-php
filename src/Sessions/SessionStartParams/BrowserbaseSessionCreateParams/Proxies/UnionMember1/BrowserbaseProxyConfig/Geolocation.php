<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1\BrowserbaseProxyConfig;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type GeolocationShape = array{
 *   country: string, city?: string|null, state?: string|null
 * }
 */
final class Geolocation implements BaseModel
{
    /** @use SdkModel<GeolocationShape> */
    use SdkModel;

    #[Required]
    public string $country;

    #[Optional]
    public ?string $city;

    #[Optional]
    public ?string $state;

    /**
     * `new Geolocation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Geolocation::with(country: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Geolocation)->withCountry(...)
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
        string $country,
        ?string $city = null,
        ?string $state = null
    ): self {
        $self = new self;

        $self['country'] = $country;

        null !== $city && $self['city'] = $city;
        null !== $state && $self['state'] = $state;

        return $self;
    }

    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
