<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteAgentParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig;
use Stagehand\Sessions\SessionExecuteAgentParams\AgentConfig\Provider;

/**
 * @phpstan-type AgentConfigShape = array{
 *   cua?: bool|null,
 *   model?: string|null|ModelConfig,
 *   provider?: value-of<Provider>|null,
 *   systemPrompt?: string|null,
 * }
 */
final class AgentConfig implements BaseModel
{
    /** @use SdkModel<AgentConfigShape> */
    use SdkModel;

    /**
     * Enable Computer Use Agent mode.
     */
    #[Optional]
    public ?bool $cua;

    #[Optional]
    public string|ModelConfig|null $model;

    /** @var value-of<Provider>|null $provider */
    #[Optional(enum: Provider::class)]
    public ?string $provider;

    #[Optional]
    public ?string $systemPrompt;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param string|ModelConfig|array{
     *   apiKey?: string|null,
     *   baseURL?: string|null,
     *   model?: string|null,
     *   provider?: value-of<ModelConfig\Provider>|null,
     * } $model
     * @param Provider|value-of<Provider> $provider
     */
    public static function with(
        ?bool $cua = null,
        string|ModelConfig|array|null $model = null,
        Provider|string|null $provider = null,
        ?string $systemPrompt = null,
    ): self {
        $self = new self;

        null !== $cua && $self['cua'] = $cua;
        null !== $model && $self['model'] = $model;
        null !== $provider && $self['provider'] = $provider;
        null !== $systemPrompt && $self['systemPrompt'] = $systemPrompt;

        return $self;
    }

    /**
     * Enable Computer Use Agent mode.
     */
    public function withCua(bool $cua): self
    {
        $self = clone $this;
        $self['cua'] = $cua;

        return $self;
    }

    /**
     * @param string|ModelConfig|array{
     *   apiKey?: string|null,
     *   baseURL?: string|null,
     *   model?: string|null,
     *   provider?: value-of<ModelConfig\Provider>|null,
     * } $model
     */
    public function withModel(string|ModelConfig|array $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * @param Provider|value-of<Provider> $provider
     */
    public function withProvider(Provider|string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    public function withSystemPrompt(string $systemPrompt): self
    {
        $self = clone $this;
        $self['systemPrompt'] = $systemPrompt;

        return $self;
    }
}
