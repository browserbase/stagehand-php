<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList\BrowserbaseProxyConfig;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList\ExternalProxyConfig;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Region;

/**
 * @phpstan-import-type BrowserSettingsShape from \Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings
 * @phpstan-import-type ProxiesShape from \Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies
 *
 * @phpstan-type BrowserbaseSessionCreateParamsShape = array{
 *   browserSettings?: null|BrowserSettings|BrowserSettingsShape,
 *   extensionID?: string|null,
 *   keepAlive?: bool|null,
 *   projectID?: string|null,
 *   proxies?: ProxiesShape|null,
 *   region?: null|Region|value-of<Region>,
 *   timeout?: float|null,
 *   userMetadata?: array<string,mixed>|null,
 * }
 */
final class BrowserbaseSessionCreateParams implements BaseModel
{
    /** @use SdkModel<BrowserbaseSessionCreateParamsShape> */
    use SdkModel;

    #[Optional]
    public ?BrowserSettings $browserSettings;

    #[Optional('extensionId')]
    public ?string $extensionID;

    #[Optional]
    public ?bool $keepAlive;

    #[Optional('projectId')]
    public ?string $projectID;

    /** @var bool|list<BrowserbaseProxyConfig|ExternalProxyConfig>|null $proxies */
    #[Optional(union: Proxies::class)]
    public bool|array|null $proxies;

    /** @var value-of<Region>|null $region */
    #[Optional(enum: Region::class)]
    public ?string $region;

    #[Optional]
    public ?float $timeout;

    /** @var array<string,mixed>|null $userMetadata */
    #[Optional(map: 'mixed')]
    public ?array $userMetadata;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param BrowserSettings|BrowserSettingsShape|null $browserSettings
     * @param ProxiesShape|null $proxies
     * @param Region|value-of<Region>|null $region
     * @param array<string,mixed>|null $userMetadata
     */
    public static function with(
        BrowserSettings|array|null $browserSettings = null,
        ?string $extensionID = null,
        ?bool $keepAlive = null,
        ?string $projectID = null,
        bool|array|null $proxies = null,
        Region|string|null $region = null,
        ?float $timeout = null,
        ?array $userMetadata = null,
    ): self {
        $self = new self;

        null !== $browserSettings && $self['browserSettings'] = $browserSettings;
        null !== $extensionID && $self['extensionID'] = $extensionID;
        null !== $keepAlive && $self['keepAlive'] = $keepAlive;
        null !== $projectID && $self['projectID'] = $projectID;
        null !== $proxies && $self['proxies'] = $proxies;
        null !== $region && $self['region'] = $region;
        null !== $timeout && $self['timeout'] = $timeout;
        null !== $userMetadata && $self['userMetadata'] = $userMetadata;

        return $self;
    }

    /**
     * @param BrowserSettings|BrowserSettingsShape $browserSettings
     */
    public function withBrowserSettings(
        BrowserSettings|array $browserSettings
    ): self {
        $self = clone $this;
        $self['browserSettings'] = $browserSettings;

        return $self;
    }

    public function withExtensionID(string $extensionID): self
    {
        $self = clone $this;
        $self['extensionID'] = $extensionID;

        return $self;
    }

    public function withKeepAlive(bool $keepAlive): self
    {
        $self = clone $this;
        $self['keepAlive'] = $keepAlive;

        return $self;
    }

    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    /**
     * @param ProxiesShape $proxies
     */
    public function withProxies(bool|array $proxies): self
    {
        $self = clone $this;
        $self['proxies'] = $proxies;

        return $self;
    }

    /**
     * @param Region|value-of<Region> $region
     */
    public function withRegion(Region|string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }

    public function withTimeout(float $timeout): self
    {
        $self = clone $this;
        $self['timeout'] = $timeout;

        return $self;
    }

    /**
     * @param array<string,mixed> $userMetadata
     */
    public function withUserMetadata(array $userMetadata): self
    {
        $self = clone $this;
        $self['userMetadata'] = $userMetadata;

        return $self;
    }
}
