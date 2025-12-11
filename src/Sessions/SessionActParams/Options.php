<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionActParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig;
use Stagehand\Sessions\ModelConfig\Provider;

/**
 * @phpstan-type OptionsShape = array{
 *   model?: ModelConfig|null,
 *   timeout?: int|null,
 *   variables?: array<string,string>|null,
 * }
 */
final class Options implements BaseModel
{
    /** @use SdkModel<OptionsShape> */
    use SdkModel;

    #[Optional]
    public ?ModelConfig $model;

    /**
     * Timeout in milliseconds.
     */
    #[Optional]
    public ?int $timeout;

    /**
     * Template variables for instruction.
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
     * @param ModelConfig|array{
     *   apiKey?: string|null,
     *   baseURL?: string|null,
     *   model?: string|null,
     *   provider?: value-of<Provider>|null,
     * } $model
     * @param array<string,string> $variables
     */
    public static function with(
        ModelConfig|array|null $model = null,
        ?int $timeout = null,
        ?array $variables = null,
    ): self {
        $self = new self;

        null !== $model && $self['model'] = $model;
        null !== $timeout && $self['timeout'] = $timeout;
        null !== $variables && $self['variables'] = $variables;

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
     * Timeout in milliseconds.
     */
    public function withTimeout(int $timeout): self
    {
        $self = clone $this;
        $self['timeout'] = $timeout;

        return $self;
    }

    /**
     * Template variables for instruction.
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
