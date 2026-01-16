<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionActParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig\ModelConfigObject;

/**
 * @phpstan-import-type ModelConfigVariants from \Stagehand\Sessions\ModelConfig
 * @phpstan-import-type ModelConfigShape from \Stagehand\Sessions\ModelConfig
 *
 * @phpstan-type OptionsShape = array{
 *   model?: ModelConfigShape|null,
 *   timeout?: float|null,
 *   variables?: array<string,string>|null,
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    /**
     * Model name string with provider prefix. Always use the format 'provider/model-name' (e.g., 'openai/gpt-4o', 'anthropic/claude-sonnet-4-5-20250929', 'google/gemini-2.0-flash').
     *
     * @var ModelConfigVariants|null $model
     */
    #[Optional]
    public string|ModelConfigObject|null $model;

    /**
     * Timeout in ms for the action.
     */
    #[Optional]
    public ?float $timeout;

    /**
     * Variables to substitute in the action instruction.
     *
     * @var array<string,string>|null $variables
     */
    #[Optional(map: 'string')]
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
     * @param ModelConfigShape|null $model
     * @param array<string,string>|null $variables
     */
    public static function with(
        string|ModelConfigObject|array|null $model = null,
        ?float $timeout = null,
        ?array $variables = null,
    ): self {
        $self = new self;

        null !== $model && $self['model'] = $model;
        null !== $timeout && $self['timeout'] = $timeout;
        null !== $variables && $self['variables'] = $variables;

        return $self;
    }

    /**
     * Model name string with provider prefix. Always use the format 'provider/model-name' (e.g., 'openai/gpt-4o', 'anthropic/claude-sonnet-4-5-20250929', 'google/gemini-2.0-flash').
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
     * Timeout in ms for the action.
     */
    public function withTimeout(float $timeout): self
    {
        $self = clone $this;
        $self['timeout'] = $timeout;

        return $self;
    }

    /**
     * Variables to substitute in the action instruction.
     *
     * @param array<string,string> $variables
     */
    public function withVariables(array $variables): self
    {
        $self = clone $this;
        $self['variables'] = $variables;

        return $self;
    }
}
