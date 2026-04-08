<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\ModelClientOptions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionStartParams\ModelClientOptions\GenericModelClientOptions\ProviderOptions\BedrockAPIKeyProviderOptions;
use Stagehand\Sessions\SessionStartParams\ModelClientOptions\GenericModelClientOptions\ProviderOptions\BedrockAwsCredentialsProviderOptions;
use Stagehand\Sessions\SessionStartParams\ModelClientOptions\GenericModelClientOptions\ProviderOptions\GoogleVertexProviderOptions;

/**
 * @phpstan-import-type ProviderOptionsVariants from \Stagehand\Sessions\SessionStartParams\ModelClientOptions\GenericModelClientOptions\ProviderOptions
 * @phpstan-import-type ProviderOptionsShape from \Stagehand\Sessions\SessionStartParams\ModelClientOptions\GenericModelClientOptions\ProviderOptions
 *
 * @phpstan-type GenericModelClientOptionsShape = array{
 *   apiKey?: string|null,
 *   baseURL?: string|null,
 *   headers?: array<string,string>|null,
 *   providerOptions?: ProviderOptionsShape|null,
 *   skipAPIKeyFallback?: bool|null,
 * }
 */
final class GenericModelClientOptions implements BaseModel
{
    /** @use SdkModel<GenericModelClientOptionsShape> */
    use SdkModel;

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
     * Custom headers for the model provider.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string')]
    public ?array $headers;

    /**
     * Provider-specific options passed through to the AI SDK provider constructor. For Bedrock: { region, accessKeyId, secretAccessKey, sessionToken }. For Vertex: { project, location, googleAuthOptions }.
     *
     * @var ProviderOptionsVariants|null $providerOptions
     */
    #[Optional]
    public BedrockAPIKeyProviderOptions|BedrockAwsCredentialsProviderOptions|GoogleVertexProviderOptions|null $providerOptions;

    /**
     * When true, hosted sessions will not copy x-model-api-key into model.apiKey. Use this when auth is carried through providerOptions instead of an API key.
     */
    #[Optional('skipApiKeyFallback')]
    public ?bool $skipAPIKeyFallback;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,string>|null $headers
     * @param ProviderOptionsShape|null $providerOptions
     */
    public static function with(
        ?string $apiKey = null,
        ?string $baseURL = null,
        ?array $headers = null,
        BedrockAPIKeyProviderOptions|array|BedrockAwsCredentialsProviderOptions|GoogleVertexProviderOptions|null $providerOptions = null,
        ?bool $skipAPIKeyFallback = null,
    ): self {
        $self = new self;

        null !== $apiKey && $self['apiKey'] = $apiKey;
        null !== $baseURL && $self['baseURL'] = $baseURL;
        null !== $headers && $self['headers'] = $headers;
        null !== $providerOptions && $self['providerOptions'] = $providerOptions;
        null !== $skipAPIKeyFallback && $self['skipAPIKeyFallback'] = $skipAPIKeyFallback;

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
     * Custom headers for the model provider.
     *
     * @param array<string,string> $headers
     */
    public function withHeaders(array $headers): self
    {
        $self = clone $this;
        $self['headers'] = $headers;

        return $self;
    }

    /**
     * Provider-specific options passed through to the AI SDK provider constructor. For Bedrock: { region, accessKeyId, secretAccessKey, sessionToken }. For Vertex: { project, location, googleAuthOptions }.
     *
     * @param ProviderOptionsShape $providerOptions
     */
    public function withProviderOptions(
        BedrockAPIKeyProviderOptions|array|BedrockAwsCredentialsProviderOptions|GoogleVertexProviderOptions $providerOptions,
    ): self {
        $self = clone $this;
        $self['providerOptions'] = $providerOptions;

        return $self;
    }

    /**
     * When true, hosted sessions will not copy x-model-api-key into model.apiKey. Use this when auth is carried through providerOptions instead of an API key.
     */
    public function withSkipAPIKeyFallback(bool $skipAPIKeyFallback): self
    {
        $self = clone $this;
        $self['skipAPIKeyFallback'] = $skipAPIKeyFallback;

        return $self;
    }
}
