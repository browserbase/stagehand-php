<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig\ModelConfigObject;

/**
 * @phpstan-import-type ModelConfigShape from \Stagehand\Sessions\ModelConfig
 *
 * @phpstan-type AgentConfigShape = array{
 *   cua?: bool|null, model?: ModelConfigShape|null, systemPrompt?: string|null
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
     */
    #[Optional]
    public string|ModelConfigObject|null $model;

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
     * @param ModelConfigShape $model
     */
    public static function with(
        ?bool $cua = null,
        string|ModelConfigObject|array|null $model = null,
        ?string $systemPrompt = null,
    ): self {
        $self = new self;

        null !== $cua && $self['cua'] = $cua;
        null !== $model && $self['model'] = $model;
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
     * Custom system prompt for the agent.
     */
    public function withSystemPrompt(string $systemPrompt): self
    {
        $self = clone $this;
        $self['systemPrompt'] = $systemPrompt;

        return $self;
    }
}
