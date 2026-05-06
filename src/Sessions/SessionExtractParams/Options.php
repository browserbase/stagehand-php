<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExtractParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig;

/**
 * @phpstan-import-type ModelVariants from \Stagehand\Sessions\SessionExtractParams\Options\Model
 * @phpstan-import-type ModelShape from \Stagehand\Sessions\SessionExtractParams\Options\Model
 *
 * @phpstan-type OptionsShape = array{
 *   ignoreSelectors?: list<string>|null,
 *   model?: ModelShape|null,
 *   selector?: string|null,
 *   timeout?: float|null,
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    /**
     * Selectors for elements and subtrees that should be excluded from extraction.
     *
     * @var list<string>|null $ignoreSelectors
     */
    #[Optional(list: 'string')]
    public ?array $ignoreSelectors;

    /**
     * Model configuration object or model name string (e.g., 'openai/gpt-5-nano').
     *
     * @var ModelVariants|null $model
     */
    #[Optional]
    public string|ModelConfig|null $model;

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
     * @param list<string>|null $ignoreSelectors
     * @param ModelShape|null $model
     */
    public static function with(
        ?array $ignoreSelectors = null,
        string|ModelConfig|array|null $model = null,
        ?string $selector = null,
        ?float $timeout = null,
    ): self {
        $self = new self;

        null !== $ignoreSelectors && $self['ignoreSelectors'] = $ignoreSelectors;
        null !== $model && $self['model'] = $model;
        null !== $selector && $self['selector'] = $selector;
        null !== $timeout && $self['timeout'] = $timeout;

        return $self;
    }

    /**
     * Selectors for elements and subtrees that should be excluded from extraction.
     *
     * @param list<string> $ignoreSelectors
     */
    public function withIgnoreSelectors(array $ignoreSelectors): self
    {
        $self = clone $this;
        $self['ignoreSelectors'] = $ignoreSelectors;

        return $self;
    }

    /**
     * Model configuration object or model name string (e.g., 'openai/gpt-5-nano').
     *
     * @param ModelShape $model
     */
    public function withModel(string|ModelConfig|array $model): self
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
