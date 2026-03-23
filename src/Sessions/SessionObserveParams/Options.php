<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionObserveParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig;
use Stagehand\Sessions\SessionObserveParams\Options\Variable;

/**
 * @phpstan-import-type ModelVariants from \Stagehand\Sessions\SessionObserveParams\Options\Model
 * @phpstan-import-type VariableVariants from \Stagehand\Sessions\SessionObserveParams\Options\Variable
 * @phpstan-import-type ModelShape from \Stagehand\Sessions\SessionObserveParams\Options\Model
 * @phpstan-import-type VariableShape from \Stagehand\Sessions\SessionObserveParams\Options\Variable
 *
 * @phpstan-type OptionsShape = array{
 *   model?: ModelShape|null,
 *   selector?: string|null,
 *   timeout?: float|null,
 *   variables?: array<string,VariableShape>|null,
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    /**
     * Model configuration object or model name string (e.g., 'openai/gpt-5-nano').
     *
     * @var ModelVariants|null $model
     */
    #[Optional]
    public string|ModelConfig|null $model;

    /**
     * CSS selector to scope observation to a specific element.
     */
    #[Optional]
    public ?string $selector;

    /**
     * Timeout in ms for the observation.
     */
    #[Optional]
    public ?float $timeout;

    /**
     * Variables whose names are exposed to the model so observe() returns %variableName% placeholders in suggested action arguments instead of literal values. Accepts flat primitives or { value, description? } objects.
     *
     * @var array<string,VariableVariants>|null $variables
     */
    #[Optional(map: Variable::class)]
    public ?array $variables;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ModelShape|null $model
     * @param array<string,VariableShape>|null $variables
     */
    public static function with(
        string|ModelConfig|array|null $model = null,
        ?string $selector = null,
        ?float $timeout = null,
        ?array $variables = null,
    ): self {
        $self = new self;

        null !== $model && $self['model'] = $model;
        null !== $selector && $self['selector'] = $selector;
        null !== $timeout && $self['timeout'] = $timeout;
        null !== $variables && $self['variables'] = $variables;

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
     * CSS selector to scope observation to a specific element.
     */
    public function withSelector(string $selector): self
    {
        $self = clone $this;
        $self['selector'] = $selector;

        return $self;
    }

    /**
     * Timeout in ms for the observation.
     */
    public function withTimeout(float $timeout): self
    {
        $self = clone $this;
        $self['timeout'] = $timeout;

        return $self;
    }

    /**
     * Variables whose names are exposed to the model so observe() returns %variableName% placeholders in suggested action arguments instead of literal values. Accepts flat primitives or { value, description? } objects.
     *
     * @param array<string,VariableShape> $variables
     */
    public function withVariables(array $variables): self
    {
        $self = clone $this;
        $self['variables'] = $variables;

        return $self;
    }
}
