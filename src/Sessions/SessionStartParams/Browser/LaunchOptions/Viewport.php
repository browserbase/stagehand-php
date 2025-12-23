<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\Browser\LaunchOptions;

use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type ViewportShape = array{height: float, width: float}
 */
final class Viewport implements BaseModel
{
    /** @use SdkModel<ViewportShape> */
    use SdkModel;

    #[Required]
    public float $height;

    #[Required]
    public float $width;

    /**
     * `new Viewport()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Viewport::with(height: ..., width: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Viewport)->withHeight(...)->withWidth(...)
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
    public static function with(float $height, float $width): self
    {
        $self = new self;

        $self['height'] = $height;
        $self['width'] = $width;

        return $self;
    }

    public function withHeight(float $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    public function withWidth(float $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
