<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\Browser;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionStartParams\Browser\LaunchOptions\IgnoreDefaultArgs;
use Stagehand\Sessions\SessionStartParams\Browser\LaunchOptions\Proxy;
use Stagehand\Sessions\SessionStartParams\Browser\LaunchOptions\Viewport;

/**
 * @phpstan-import-type IgnoreDefaultArgsShape from \Stagehand\Sessions\SessionStartParams\Browser\LaunchOptions\IgnoreDefaultArgs
 * @phpstan-import-type ProxyShape from \Stagehand\Sessions\SessionStartParams\Browser\LaunchOptions\Proxy
 * @phpstan-import-type ViewportShape from \Stagehand\Sessions\SessionStartParams\Browser\LaunchOptions\Viewport
 *
 * @phpstan-type LaunchOptionsShape = array{
 *   acceptDownloads?: bool|null,
 *   args?: list<string>|null,
 *   cdpURL?: string|null,
 *   chromiumSandbox?: bool|null,
 *   connectTimeoutMs?: float|null,
 *   deviceScaleFactor?: float|null,
 *   devtools?: bool|null,
 *   downloadsPath?: string|null,
 *   executablePath?: string|null,
 *   hasTouch?: bool|null,
 *   headless?: bool|null,
 *   ignoreDefaultArgs?: IgnoreDefaultArgsShape|null,
 *   ignoreHTTPSErrors?: bool|null,
 *   locale?: string|null,
 *   preserveUserDataDir?: bool|null,
 *   proxy?: null|Proxy|ProxyShape,
 *   userDataDir?: string|null,
 *   viewport?: null|Viewport|ViewportShape,
 * }
 */
final class LaunchOptions implements BaseModel
{
    /** @use SdkModel<LaunchOptionsShape> */
    use SdkModel;

    #[Optional]
    public ?bool $acceptDownloads;

    /** @var list<string>|null $args */
    #[Optional(list: 'string')]
    public ?array $args;

    #[Optional('cdpUrl')]
    public ?string $cdpURL;

    #[Optional]
    public ?bool $chromiumSandbox;

    #[Optional]
    public ?float $connectTimeoutMs;

    #[Optional]
    public ?float $deviceScaleFactor;

    #[Optional]
    public ?bool $devtools;

    #[Optional]
    public ?string $downloadsPath;

    #[Optional]
    public ?string $executablePath;

    #[Optional]
    public ?bool $hasTouch;

    #[Optional]
    public ?bool $headless;

    /** @var bool|list<string>|null $ignoreDefaultArgs */
    #[Optional(union: IgnoreDefaultArgs::class)]
    public bool|array|null $ignoreDefaultArgs;

    #[Optional]
    public ?bool $ignoreHTTPSErrors;

    #[Optional]
    public ?string $locale;

    #[Optional]
    public ?bool $preserveUserDataDir;

    #[Optional]
    public ?Proxy $proxy;

    #[Optional]
    public ?string $userDataDir;

    #[Optional]
    public ?Viewport $viewport;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $args
     * @param IgnoreDefaultArgsShape|null $ignoreDefaultArgs
     * @param Proxy|ProxyShape|null $proxy
     * @param Viewport|ViewportShape|null $viewport
     */
    public static function with(
        ?bool $acceptDownloads = null,
        ?array $args = null,
        ?string $cdpURL = null,
        ?bool $chromiumSandbox = null,
        ?float $connectTimeoutMs = null,
        ?float $deviceScaleFactor = null,
        ?bool $devtools = null,
        ?string $downloadsPath = null,
        ?string $executablePath = null,
        ?bool $hasTouch = null,
        ?bool $headless = null,
        bool|array|null $ignoreDefaultArgs = null,
        ?bool $ignoreHTTPSErrors = null,
        ?string $locale = null,
        ?bool $preserveUserDataDir = null,
        Proxy|array|null $proxy = null,
        ?string $userDataDir = null,
        Viewport|array|null $viewport = null,
    ): self {
        $self = new self;

        null !== $acceptDownloads && $self['acceptDownloads'] = $acceptDownloads;
        null !== $args && $self['args'] = $args;
        null !== $cdpURL && $self['cdpURL'] = $cdpURL;
        null !== $chromiumSandbox && $self['chromiumSandbox'] = $chromiumSandbox;
        null !== $connectTimeoutMs && $self['connectTimeoutMs'] = $connectTimeoutMs;
        null !== $deviceScaleFactor && $self['deviceScaleFactor'] = $deviceScaleFactor;
        null !== $devtools && $self['devtools'] = $devtools;
        null !== $downloadsPath && $self['downloadsPath'] = $downloadsPath;
        null !== $executablePath && $self['executablePath'] = $executablePath;
        null !== $hasTouch && $self['hasTouch'] = $hasTouch;
        null !== $headless && $self['headless'] = $headless;
        null !== $ignoreDefaultArgs && $self['ignoreDefaultArgs'] = $ignoreDefaultArgs;
        null !== $ignoreHTTPSErrors && $self['ignoreHTTPSErrors'] = $ignoreHTTPSErrors;
        null !== $locale && $self['locale'] = $locale;
        null !== $preserveUserDataDir && $self['preserveUserDataDir'] = $preserveUserDataDir;
        null !== $proxy && $self['proxy'] = $proxy;
        null !== $userDataDir && $self['userDataDir'] = $userDataDir;
        null !== $viewport && $self['viewport'] = $viewport;

        return $self;
    }

    public function withAcceptDownloads(bool $acceptDownloads): self
    {
        $self = clone $this;
        $self['acceptDownloads'] = $acceptDownloads;

        return $self;
    }

    /**
     * @param list<string> $args
     */
    public function withArgs(array $args): self
    {
        $self = clone $this;
        $self['args'] = $args;

        return $self;
    }

    public function withCdpURL(string $cdpURL): self
    {
        $self = clone $this;
        $self['cdpURL'] = $cdpURL;

        return $self;
    }

    public function withChromiumSandbox(bool $chromiumSandbox): self
    {
        $self = clone $this;
        $self['chromiumSandbox'] = $chromiumSandbox;

        return $self;
    }

    public function withConnectTimeoutMs(float $connectTimeoutMs): self
    {
        $self = clone $this;
        $self['connectTimeoutMs'] = $connectTimeoutMs;

        return $self;
    }

    public function withDeviceScaleFactor(float $deviceScaleFactor): self
    {
        $self = clone $this;
        $self['deviceScaleFactor'] = $deviceScaleFactor;

        return $self;
    }

    public function withDevtools(bool $devtools): self
    {
        $self = clone $this;
        $self['devtools'] = $devtools;

        return $self;
    }

    public function withDownloadsPath(string $downloadsPath): self
    {
        $self = clone $this;
        $self['downloadsPath'] = $downloadsPath;

        return $self;
    }

    public function withExecutablePath(string $executablePath): self
    {
        $self = clone $this;
        $self['executablePath'] = $executablePath;

        return $self;
    }

    public function withHasTouch(bool $hasTouch): self
    {
        $self = clone $this;
        $self['hasTouch'] = $hasTouch;

        return $self;
    }

    public function withHeadless(bool $headless): self
    {
        $self = clone $this;
        $self['headless'] = $headless;

        return $self;
    }

    /**
     * @param IgnoreDefaultArgsShape $ignoreDefaultArgs
     */
    public function withIgnoreDefaultArgs(bool|array $ignoreDefaultArgs): self
    {
        $self = clone $this;
        $self['ignoreDefaultArgs'] = $ignoreDefaultArgs;

        return $self;
    }

    public function withIgnoreHTTPSErrors(bool $ignoreHTTPSErrors): self
    {
        $self = clone $this;
        $self['ignoreHTTPSErrors'] = $ignoreHTTPSErrors;

        return $self;
    }

    public function withLocale(string $locale): self
    {
        $self = clone $this;
        $self['locale'] = $locale;

        return $self;
    }

    public function withPreserveUserDataDir(bool $preserveUserDataDir): self
    {
        $self = clone $this;
        $self['preserveUserDataDir'] = $preserveUserDataDir;

        return $self;
    }

    /**
     * @param Proxy|ProxyShape $proxy
     */
    public function withProxy(Proxy|array $proxy): self
    {
        $self = clone $this;
        $self['proxy'] = $proxy;

        return $self;
    }

    public function withUserDataDir(string $userDataDir): self
    {
        $self = clone $this;
        $self['userDataDir'] = $userDataDir;

        return $self;
    }

    /**
     * @param Viewport|ViewportShape $viewport
     */
    public function withViewport(Viewport|array $viewport): self
    {
        $self = clone $this;
        $self['viewport'] = $viewport;

        return $self;
    }
}
