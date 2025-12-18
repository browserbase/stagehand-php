<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionStartParams\Browser\LaunchOptions;
use Stagehand\Sessions\SessionStartParams\Browser\Type;

/**
 * @phpstan-import-type LaunchOptionsShape from \Stagehand\Sessions\SessionStartParams\Browser\LaunchOptions
 *
 * @phpstan-type BrowserShape = array{
 *   cdpURL?: string|null,
 *   launchOptions?: null|LaunchOptions|LaunchOptionsShape,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class Browser implements BaseModel
{
    /** @use SdkModel<BrowserShape> */
    use SdkModel;

    /**
     * Chrome DevTools Protocol URL for connecting to existing browser.
     */
    #[Optional('cdpUrl')]
    public ?string $cdpURL;

    #[Optional]
    public ?LaunchOptions $launchOptions;

    /**
     * Browser type to use.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param LaunchOptions|LaunchOptionsShape|null $launchOptions
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?string $cdpURL = null,
        LaunchOptions|array|null $launchOptions = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        null !== $cdpURL && $self['cdpURL'] = $cdpURL;
        null !== $launchOptions && $self['launchOptions'] = $launchOptions;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Chrome DevTools Protocol URL for connecting to existing browser.
     */
    public function withCdpURL(string $cdpURL): self
    {
        $self = clone $this;
        $self['cdpURL'] = $cdpURL;

        return $self;
    }

    /**
     * @param LaunchOptions|LaunchOptionsShape $launchOptions
     */
    public function withLaunchOptions(LaunchOptions|array $launchOptions): self
    {
        $self = clone $this;
        $self['launchOptions'] = $launchOptions;

        return $self;
    }

    /**
     * Browser type to use.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
