<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig\Provider;

/**
 * @phpstan-type ModelConfigShape = array{
 *   apiKey?: string|null,
 *   baseURL?: string|null,
 *   model?: string|null,
 *   provider?: value-of<Provider>|null,
 * }
 */
final class ModelConfig implements BaseModel
{
    /** @use SdkModel<ModelConfigShape> */
    use SdkModel;

    /**
     * API key for the model provider.
     */
    #[Optional]
    public ?string $apiKey;

    /**
     * Custom base URL for API.
     */
    #[Optional]
    public ?string $baseURL;

    /**
     * Model name.
     */
    #[Optional]
    public ?string $model;

    /** @var value-of<Provider>|null $provider */
    #[Optional(enum: Provider::class)]
    public ?string $provider;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Provider|value-of<Provider> $provider
     */
    public static function with(
        ?string $apiKey = null,
        ?string $baseURL = null,
        ?string $model = null,
        Provider|string|null $provider = null,
    ): self {
        $self = new self;

        null !== $apiKey && $self['apiKey'] = $apiKey;
        null !== $baseURL && $self['baseURL'] = $baseURL;
        null !== $model && $self['model'] = $model;
        null !== $provider && $self['provider'] = $provider;

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
     * Custom base URL for API.
     */
    public function withBaseURL(string $baseURL): self
    {
        $self = clone $this;
        $self['baseURL'] = $baseURL;

        return $self;
    }

    /**
     * Model name.
     */
    public function withModel(string $model): self
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
}
