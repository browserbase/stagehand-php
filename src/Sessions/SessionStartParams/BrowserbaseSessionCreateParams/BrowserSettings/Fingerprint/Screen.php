<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint;

use StagehandSDK\Core\Attributes\Optional;
use StagehandSDK\Core\Concerns\SdkModel;
use StagehandSDK\Core\Contracts\BaseModel;

/**
 * @phpstan-type ScreenShape = array{
 *   maxHeight?: float|null,
 *   maxWidth?: float|null,
 *   minHeight?: float|null,
 *   minWidth?: float|null,
 * }
 */
final class Screen implements BaseModel
{
    /** @use SdkModel<ScreenShape> */
    use SdkModel;

    #[Optional]
    public ?float $maxHeight;

    #[Optional]
    public ?float $maxWidth;

    #[Optional]
    public ?float $minHeight;

    #[Optional]
    public ?float $minWidth;

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
        ?float $maxHeight = null,
        ?float $maxWidth = null,
        ?float $minHeight = null,
        ?float $minWidth = null,
    ): self {
        $self = new self;

        null !== $maxHeight && $self['maxHeight'] = $maxHeight;
        null !== $maxWidth && $self['maxWidth'] = $maxWidth;
        null !== $minHeight && $self['minHeight'] = $minHeight;
        null !== $minWidth && $self['minWidth'] = $minWidth;

        return $self;
    }

    public function withMaxHeight(float $maxHeight): self
    {
        $self = clone $this;
        $self['maxHeight'] = $maxHeight;

        return $self;
    }

    public function withMaxWidth(float $maxWidth): self
    {
        $self = clone $this;
        $self['maxWidth'] = $maxWidth;

        return $self;
    }

    public function withMinHeight(float $minHeight): self
    {
        $self = clone $this;
        $self['minHeight'] = $minHeight;

        return $self;
    }

    public function withMinWidth(float $minWidth): self
    {
        $self = clone $this;
        $self['minWidth'] = $minWidth;

        return $self;
    }
}
