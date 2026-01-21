<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionActParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig;

/**
 * @phpstan-import-type ModelVariants from \Stagehand\Sessions\SessionActParams\Options\Model
 * @phpstan-import-type ModelShape from \Stagehand\Sessions\SessionActParams\Options\Model
 *
 * @phpstan-type OptionsShape = array{
 *   model?: ModelShape|null,
 *   timeout?: float|null,
 *   variables?: array<string,string>|null,
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
     * @param ModelShape|null $model
     * @param array<string,string>|null $variables
     */
    public static function with(
        string|ModelConfig|array|null $model = null,
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
