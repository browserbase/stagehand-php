<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig\Provider;

/**
 * @phpstan-type ModelConfigShape = array{
 *   modelName: string,
 *   apiKey?: string|null,
 *   baseURL?: string|null,
 *   provider?: null|Provider|value-of<Provider>,
 * }
 */
final class ModelConfig implements BaseModel
{
    /** @use SdkModel<ModelConfigShape> */
    use SdkModel;

    /**
     * Model name string with provider prefix (e.g., 'openai/gpt-5-nano').
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
     * `new ModelConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ModelConfig::with(modelName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ModelConfig)->withModelName(...)
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
     * Model name string with provider prefix (e.g., 'openai/gpt-5-nano').
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
