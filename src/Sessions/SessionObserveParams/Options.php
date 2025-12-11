<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionObserveParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig;
use Stagehand\Sessions\ModelConfig\Provider;

/**
 * @phpstan-type OptionsShape = array{
 *   model?: ModelConfig|null, selector?: string|null, timeout?: int|null
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    #[Optional]
    public ?ModelConfig $model;

    /**
     * Observe only elements matching this selector.
     */
    #[Optional]
    public ?string $selector;

    #[Optional]
    public ?int $timeout;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ModelConfig|array{
     *   apiKey?: string|null,
     *   baseURL?: string|null,
     *   model?: string|null,
     *   provider?: value-of<Provider>|null,
     * } $model
     */
    public static function with(
        ModelConfig|array|null $model = null,
        ?string $selector = null,
        ?int $timeout = null,
    ): self {
        $self = new self;

        null !== $model && $self['model'] = $model;
        null !== $selector && $self['selector'] = $selector;
        null !== $timeout && $self['timeout'] = $timeout;

        return $self;
    }

    /**
     * @param ModelConfig|array{
     *   apiKey?: string|null,
     *   baseURL?: string|null,
     *   model?: string|null,
     *   provider?: value-of<Provider>|null,
     * } $model
     */
    public function withModel(ModelConfig|array $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Observe only elements matching this selector.
     */
    public function withSelector(string $selector): self
    {
        $self = clone $this;
        $self['selector'] = $selector;

        return $self;
    }

    public function withTimeout(int $timeout): self
    {
        $self = clone $this;
        $self['timeout'] = $timeout;

        return $self;
    }
}
