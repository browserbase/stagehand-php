<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\ModelConfig;

use StagehandSDK\Core\Attributes\Optional;
use StagehandSDK\Core\Attributes\Required;
use StagehandSDK\Core\Concerns\SdkModel;
use StagehandSDK\Core\Contracts\BaseModel;
use StagehandSDK\Sessions\ModelConfig\ModelConfigObject\Provider;

/**
 * @phpstan-type ModelConfigObjectShape = array{
 *   modelName: string,
 *   apiKey?: string|null,
 *   baseURL?: string|null,
 *   provider?: null|Provider|value-of<Provider>,
 * }
 */
final class ModelConfigObject implements BaseModel
{
    /** @use SdkModel<ModelConfigObjectShape> */
    use SdkModel;

    /**
     * Model name string (e.g., 'openai/gpt-5-nano', 'anthropic/claude-4.5-opus').
     */
    #[Required]
    public string $modelName;

    /**
     * API key for the model provider.
     */
    #[Optional]
    public ?string $apiKey;

    /**
     * Base URL for the model provider.
     */
    #[Optional]
    public ?string $baseURL;

    /**
     * AI provider for the model (or provide a baseURL endpoint instead).
     *
     * @var value-of<Provider>|null $provider
     */
    #[Optional(enum: Provider::class)]
    public ?string $provider;

    /**
     * `new ModelConfigObject()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ModelConfigObject::with(modelName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ModelConfigObject)->withModelName(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Provider|value-of<Provider>|null $provider
     */
    public static function with(
        string $modelName,
        ?string $apiKey = null,
        ?string $baseURL = null,
        Provider|string|null $provider = null,
    ): self {
        $self = new self;

        $self['modelName'] = $modelName;

        null !== $apiKey && $self['apiKey'] = $apiKey;
        null !== $baseURL && $self['baseURL'] = $baseURL;
        null !== $provider && $self['provider'] = $provider;

        return $self;
    }

    /**
     * Model name string (e.g., 'openai/gpt-5-nano', 'anthropic/claude-4.5-opus').
     */
    public function withModelName(string $modelName): self
    {
        $self = clone $this;
        $self['modelName'] = $modelName;

        return $self;
    }

    /**
     * API key for the model provider.
     */
    public function withAPIKey(string $apiKey): self
    {
        $self = clone $this;
        $self['apiKey'] = $apiKey;

        return $self;
    }

    /**
     * Base URL for the model provider.
     */
    public function withBaseURL(string $baseURL): self
    {
        $self = clone $this;
        $self['baseURL'] = $baseURL;

        return $self;
    }

    /**
     * AI provider for the model (or provide a baseURL endpoint instead).
     *
     * @param Provider|value-of<Provider> $provider
     */
    public function withProvider(Provider|string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }
}
