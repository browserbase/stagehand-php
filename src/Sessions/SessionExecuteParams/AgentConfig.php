<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig;
use Stagehand\Sessions\SessionExecuteParams\AgentConfig\Mode;
use Stagehand\Sessions\SessionExecuteParams\AgentConfig\Provider;

/**
 * @phpstan-import-type ModelVariants from \Stagehand\Sessions\SessionExecuteParams\AgentConfig\Model
 * @phpstan-import-type ModelShape from \Stagehand\Sessions\SessionExecuteParams\AgentConfig\Model
 *
 * @phpstan-type AgentConfigShape = array{
 *   cua?: bool|null,
 *   mode?: null|Mode|value-of<Mode>,
 *   model?: ModelShape|null,
 *   provider?: null|Provider|value-of<Provider>,
 *   systemPrompt?: string|null,
 * }
 */
final class AgentConfig implements BaseModel
{
    /** @use SdkModel<AgentConfigShape> */
    use SdkModel;

    /**
     * Deprecated. Use mode: 'cua' instead. If both are provided, mode takes precedence.
     */
    #[Optional]
    public ?bool $cua;

    /**
     * Tool mode for the agent (dom, hybrid, cua). If set, overrides cua.
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * Model configuration object or model name string (e.g., 'openai/gpt-5-nano').
     *
     * @var ModelVariants|null $model
     */
    #[Optional]
    public string|ModelConfig|null $model;

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
     * @param Mode|value-of<Mode>|null $mode
     * @param ModelShape|null $model
     * @param Provider|value-of<Provider>|null $provider
     */
    public static function with(
        ?bool $cua = null,
        Mode|string|null $mode = null,
        string|ModelConfig|array|null $model = null,
        Provider|string|null $provider = null,
        ?string $systemPrompt = null,
    ): self {
        $self = new self;

        null !== $cua && $self['cua'] = $cua;
        null !== $mode && $self['mode'] = $mode;
        null !== $model && $self['model'] = $model;
        null !== $provider && $self['provider'] = $provider;
        null !== $systemPrompt && $self['systemPrompt'] = $systemPrompt;

        return $self;
    }

    /**
     * Deprecated. Use mode: 'cua' instead. If both are provided, mode takes precedence.
     */
    public function withCua(bool $cua): self
    {
        $self = clone $this;
        $self['cua'] = $cua;

        return $self;
    }

    /**
     * Tool mode for the agent (dom, hybrid, cua). If set, overrides cua.
     *
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

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
