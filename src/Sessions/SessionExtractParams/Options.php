<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExtractParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig\ModelConfigObject;

/**
 * @phpstan-import-type ModelConfigVariants from \Stagehand\Sessions\ModelConfig
 * @phpstan-import-type ModelConfigShape from \Stagehand\Sessions\ModelConfig
 *
 * @phpstan-type OptionsShape = array{
 *   model?: ModelConfigShape|null, selector?: string|null, timeout?: float|null
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    /**
     * Model name string with provider prefix (e.g., 'openai/gpt-5-nano', 'anthropic/claude-4.5-opus').
     *
     * @var ModelConfigVariants|null $model
     */
    #[Optional]
    public string|ModelConfigObject|null $model;

    /**
     * CSS selector to scope extraction to a specific element.
     */
    #[Optional]
    public ?string $selector;

    /**
     * Timeout in ms for the extraction.
     */
    #[Optional]
    public ?float $timeout;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ModelConfigShape|null $model
     */
    public static function with(
        string|ModelConfigObject|array|null $model = null,
        ?string $selector = null,
        ?float $timeout = null,
    ): self {
        $self = new self;

        null !== $model && $self['model'] = $model;
        null !== $selector && $self['selector'] = $selector;
        null !== $timeout && $self['timeout'] = $timeout;

        return $self;
    }

    /**
     * Model name string with provider prefix (e.g., 'openai/gpt-5-nano', 'anthropic/claude-4.5-opus').
     *
     * @param ModelConfigShape $model
     */
    public function withModel(string|ModelConfigObject|array $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * CSS selector to scope extraction to a specific element.
     */
    public function withSelector(string $selector): self
    {
        $self = clone $this;
        $self['selector'] = $selector;

        return $self;
    }

    /**
     * Timeout in ms for the extraction.
     */
    public function withTimeout(float $timeout): self
    {
        $self = clone $this;
        $self['timeout'] = $timeout;

        return $self;
    }
}
