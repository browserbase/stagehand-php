<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * Options for local browser launch.
 *
 * @phpstan-type LocalBrowserLaunchOptionsShape = array{headless?: bool|null}
 */
final class LocalBrowserLaunchOptions implements BaseModel
{
    /** @use SdkModel<LocalBrowserLaunchOptionsShape> */
    use SdkModel;

    #[Optional]
    public ?bool $headless;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $headless = null): self
    {
        $self = new self;

        null !== $headless && $self['headless'] = $headless;

        return $self;
    }

    public function withHeadless(bool $headless): self
    {
        $self = clone $this;
        $self['headless'] = $headless;

        return $self;
    }
}
