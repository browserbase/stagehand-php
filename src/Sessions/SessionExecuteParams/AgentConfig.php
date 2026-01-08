<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig\ModelConfigObject;
use Stagehand\Sessions\SessionExecuteParams\AgentConfig\Provider;

/**
 * @phpstan-import-type ModelConfigVariants from \Stagehand\Sessions\ModelConfig
 * @phpstan-import-type ModelConfigShape from \Stagehand\Sessions\ModelConfig
 *
 * @phpstan-type AgentConfigShape = array{
 *   cua?: bool|null,
 *   model?: ModelConfigShape|null,
 *   provider?: null|Provider|value-of<Provider>,
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

    /**
     * Model name string with provider prefix (e.g., 'openai/gpt-5-nano', 'anthropic/claude-4.5-opus').
     *
     * @var ModelConfigVariants|null $model
     */
    #[Optional]
    public string|ModelConfigObject|null $model;

    /**
     * AI provider for the agent (legacy, use model: openai/gpt-5-nano instead).
     *
     * @var value-of<Provider>|null $provider
     */
    #[Optional(enum: Provider::class)]
    public ?string $provider;

    /**
     * Custom system prompt for the agent.
     */
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
     * @param ModelConfigShape|null $model
     * @param Provider|value-of<Provider>|null $provider
     */
    public static function with(
        ?bool $cua = null,
        string|ModelConfigObject|array|null $model = null,
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
     * AI provider for the agent (legacy, use model: openai/gpt-5-nano instead).
     *
     * @param Provider|value-of<Provider> $provider
     */
    public function withProvider(Provider|string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Custom system prompt for the agent.
     */
    public function withSystemPrompt(string $systemPrompt): self
    {
        $self = clone $this;
        $self['systemPrompt'] = $systemPrompt;

        return $self;
    }
}
