<?php

declare(strict_types=1);

namespace Stagehand\Sessions\ModelConfig;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig\VertexModelConfigObject\Auth;
use Stagehand\Sessions\ModelConfig\VertexModelConfigObject\ProviderOptions;

/**
 * @phpstan-import-type AuthShape from \Stagehand\Sessions\ModelConfig\VertexModelConfigObject\Auth
 * @phpstan-import-type ProviderOptionsShape from \Stagehand\Sessions\ModelConfig\VertexModelConfigObject\ProviderOptions
 *
 * @phpstan-type VertexModelConfigObjectShape = array{
 *   auth: Auth|AuthShape,
 *   modelName: string,
 *   provider: 'vertex',
 *   providerOptions: ProviderOptions|ProviderOptionsShape,
 *   apiKey?: string|null,
 *   baseURL?: string|null,
 *   headers?: array<string,string>|null,
 * }
 */
final class VertexModelConfigObject implements BaseModel
{
    /** @use SdkModel<VertexModelConfigObjectShape> */
    use SdkModel;

    /**
     * Vertex AI model provider.
     *
     * @var 'vertex' $provider
     */
    #[Required]
    public string $provider = 'vertex';

    /**
     * Vertex provider authentication configuration.
     */
    #[Required]
    public Auth $auth;

    /**
     * Model name string with provider prefix (e.g., 'openai/gpt-5-nano').
     */
    #[Required]
    public string $modelName;

    /**
     * Vertex provider-specific model configuration.
     */
    #[Required]
    public ProviderOptions $providerOptions;

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
     * Custom headers sent with every request to the model provider.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string')]
    public ?array $headers;

    /**
     * `new VertexModelConfigObject()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VertexModelConfigObject::with(auth: ..., modelName: ..., providerOptions: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VertexModelConfigObject)
     *   ->withAuth(...)
     *   ->withModelName(...)
     *   ->withProviderOptions(...)
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
     * @param Auth|AuthShape $auth
     * @param ProviderOptions|ProviderOptionsShape $providerOptions
     * @param array<string,string>|null $headers
     */
    public static function with(
        Auth|array $auth,
        string $modelName,
        ProviderOptions|array $providerOptions,
        ?string $apiKey = null,
        ?string $baseURL = null,
        ?array $headers = null,
    ): self {
        $self = new self;

        $self['auth'] = $auth;
        $self['modelName'] = $modelName;
        $self['providerOptions'] = $providerOptions;

        null !== $apiKey && $self['apiKey'] = $apiKey;
        null !== $baseURL && $self['baseURL'] = $baseURL;
        null !== $headers && $self['headers'] = $headers;

        return $self;
    }

    /**
     * Vertex provider authentication configuration.
     *
     * @param Auth|AuthShape $auth
     */
    public function withAuth(Auth|array $auth): self
    {
        $self = clone $this;
        $self['auth'] = $auth;

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
     * Vertex AI model provider.
     *
     * @param 'vertex' $provider
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Vertex provider-specific model configuration.
     *
     * @param ProviderOptions|ProviderOptionsShape $providerOptions
     */
    public function withProviderOptions(
        ProviderOptions|array $providerOptions
    ): self {
        $self = clone $this;
        $self['providerOptions'] = $providerOptions;

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
     * Custom headers sent with every request to the model provider.
     *
     * @param array<string,string> $headers
     */
    public function withHeaders(array $headers): self
    {
        $self = clone $this;
        $self['headers'] = $headers;

        return $self;
    }
}
