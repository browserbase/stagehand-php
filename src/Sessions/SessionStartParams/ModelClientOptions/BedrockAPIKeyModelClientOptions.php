<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\ModelClientOptions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionStartParams\ModelClientOptions\BedrockAPIKeyModelClientOptions\ProviderOptions;

/**
 * @phpstan-import-type ProviderOptionsShape from \Stagehand\Sessions\SessionStartParams\ModelClientOptions\BedrockAPIKeyModelClientOptions\ProviderOptions
 *
 * @phpstan-type BedrockAPIKeyModelClientOptionsShape = array{
 *   apiKey: string,
 *   providerOptions: ProviderOptions|ProviderOptionsShape,
 *   baseURL?: string|null,
 *   headers?: array<string,string>|null,
 *   skipAPIKeyFallback?: bool|null,
 * }
 */
final class BedrockAPIKeyModelClientOptions implements BaseModel
{
    /** @use SdkModel<BedrockAPIKeyModelClientOptionsShape> */
    use SdkModel;

    /**
     * Short-term Bedrock API key for bearer-token auth.
     */
    #[Required]
    public string $apiKey;

    #[Required]
    public ProviderOptions $providerOptions;

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
     * When true, hosted sessions will not copy x-model-api-key into model.apiKey. Use this when auth is carried through providerOptions instead of an API key.
     */
    #[Optional('skipApiKeyFallback')]
    public ?bool $skipAPIKeyFallback;

    /**
     * `new BedrockAPIKeyModelClientOptions()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BedrockAPIKeyModelClientOptions::with(apiKey: ..., providerOptions: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BedrockAPIKeyModelClientOptions)->withAPIKey(...)->withProviderOptions(...)
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
     * @param ProviderOptions|ProviderOptionsShape $providerOptions
     * @param array<string,string>|null $headers
     */
    public static function with(
        string $apiKey,
        ProviderOptions|array $providerOptions,
        ?string $baseURL = null,
        ?array $headers = null,
        ?bool $skipAPIKeyFallback = null,
    ): self {
        $self = new self;

        $self['apiKey'] = $apiKey;
        $self['providerOptions'] = $providerOptions;

        null !== $baseURL && $self['baseURL'] = $baseURL;
        null !== $headers && $self['headers'] = $headers;
        null !== $skipAPIKeyFallback && $self['skipAPIKeyFallback'] = $skipAPIKeyFallback;

        return $self;
    }

    /**
     * Short-term Bedrock API key for bearer-token auth.
     */
    public function withAPIKey(string $apiKey): self
    {
        $self = clone $this;
        $self['apiKey'] = $apiKey;

        return $self;
    }

    /**
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
     * When true, hosted sessions will not copy x-model-api-key into model.apiKey. Use this when auth is carried through providerOptions instead of an API key.
     */
    public function withSkipAPIKeyFallback(bool $skipAPIKeyFallback): self
    {
        $self = clone $this;
        $self['skipAPIKeyFallback'] = $skipAPIKeyFallback;

        return $self;
    }
}
