<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint\Browser;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint\Device;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint\HTTPVersion;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint\OperatingSystem;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint\Screen;

/**
 * @phpstan-import-type ScreenShape from \Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint\Screen
 *
 * @phpstan-type FingerprintShape = array{
 *   browsers?: list<Browser|value-of<Browser>>|null,
 *   devices?: list<Device|value-of<Device>>|null,
 *   httpVersion?: null|HTTPVersion|value-of<HTTPVersion>,
 *   locales?: list<string>|null,
 *   operatingSystems?: list<OperatingSystem|value-of<OperatingSystem>>|null,
 *   screen?: null|Screen|ScreenShape,
 * }
 */
final class Fingerprint implements BaseModel
{
    /** @use SdkModel<FingerprintShape> */
    use SdkModel;

    /** @var list<value-of<Browser>>|null $browsers */
    #[Optional(list: Browser::class)]
    public ?array $browsers;

    /** @var list<value-of<Device>>|null $devices */
    #[Optional(list: Device::class)]
    public ?array $devices;

    /** @var value-of<HTTPVersion>|null $httpVersion */
    #[Optional(enum: HTTPVersion::class)]
    public ?string $httpVersion;

    /** @var list<string>|null $locales */
    #[Optional(list: 'string')]
    public ?array $locales;

    /** @var list<value-of<OperatingSystem>>|null $operatingSystems */
    #[Optional(list: OperatingSystem::class)]
    public ?array $operatingSystems;

    #[Optional]
    public ?Screen $screen;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Browser|value-of<Browser>>|null $browsers
     * @param list<Device|value-of<Device>>|null $devices
     * @param HTTPVersion|value-of<HTTPVersion>|null $httpVersion
     * @param list<string>|null $locales
     * @param list<OperatingSystem|value-of<OperatingSystem>>|null $operatingSystems
     * @param Screen|ScreenShape|null $screen
     */
    public static function with(
        ?array $browsers = null,
        ?array $devices = null,
        HTTPVersion|string|null $httpVersion = null,
        ?array $locales = null,
        ?array $operatingSystems = null,
        Screen|array|null $screen = null,
    ): self {
        $self = new self;

        null !== $browsers && $self['browsers'] = $browsers;
        null !== $devices && $self['devices'] = $devices;
        null !== $httpVersion && $self['httpVersion'] = $httpVersion;
        null !== $locales && $self['locales'] = $locales;
        null !== $operatingSystems && $self['operatingSystems'] = $operatingSystems;
        null !== $screen && $self['screen'] = $screen;

        return $self;
    }

    /**
     * @param list<Browser|value-of<Browser>> $browsers
     */
    public function withBrowsers(array $browsers): self
    {
        $self = clone $this;
        $self['browsers'] = $browsers;

        return $self;
    }

    /**
     * @param list<Device|value-of<Device>> $devices
     */
    public function withDevices(array $devices): self
    {
        $self = clone $this;
        $self['devices'] = $devices;

        return $self;
    }

    /**
     * @param HTTPVersion|value-of<HTTPVersion> $httpVersion
     */
    public function withHTTPVersion(HTTPVersion|string $httpVersion): self
    {
        $self = clone $this;
        $self['httpVersion'] = $httpVersion;

        return $self;
    }

    /**
     * @param list<string> $locales
     */
    public function withLocales(array $locales): self
    {
        $self = clone $this;
        $self['locales'] = $locales;

        return $self;
    }

    /**
     * @param list<OperatingSystem|value-of<OperatingSystem>> $operatingSystems
     */
    public function withOperatingSystems(array $operatingSystems): self
    {
        $self = clone $this;
        $self['operatingSystems'] = $operatingSystems;

        return $self;
    }

    /**
     * @param Screen|ScreenShape $screen
     */
    public function withScreen(Screen|array $screen): self
    {
        $self = clone $this;
        $self['screen'] = $screen;

        return $self;
    }
}
