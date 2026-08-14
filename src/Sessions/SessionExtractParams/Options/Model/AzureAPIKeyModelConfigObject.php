<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExtractParams\Options\Model;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionExtractParams\Options\Model\AzureAPIKeyModelConfigObject\ProviderOptions;

/**
 * @phpstan-import-type ProviderOptionsShape from \Stagehand\Sessions\SessionExtractParams\Options\Model\AzureAPIKeyModelConfigObject\ProviderOptions
 *
 * @phpstan-type AzureAPIKeyModelConfigObjectShape = array{
 *   modelName: string,
 *   provider: 'azure',
 *   providerOptions: ProviderOptions|ProviderOptionsShape,
 *   apiKey?: string|null,
 *   baseURL?: string|null,
 *   headers?: array<string,string>|null,
 * }
 */
final class AzureAPIKeyModelConfigObject implements BaseModel
{
    /** @use SdkModel<AzureAPIKeyModelConfigObjectShape> */
    use SdkModel;

    /**
     * Azure OpenAI model provider.
     *
     * @var 'azure' $provider
     */
    #[Required]
    public string $provider = 'azure';

    /**
     * Model name string with provider prefix (e.g., 'openai/gpt-5-nano').
     */
    #[Required]
    public string $modelName;

    /**
     * Azure provider-specific model configuration.
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
     * `new AzureAPIKeyModelConfigObject()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AzureAPIKeyModelConfigObject::with(modelName: ..., providerOptions: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AzureAPIKeyModelConfigObject)->withModelName(...)->withProviderOptions(...)
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
        string $modelName,
        ProviderOptions|array $providerOptions,
        ?string $apiKey = null,
        ?string $baseURL = null,
        ?array $headers = null,
    ): self {
        $self = new self;

        $self['modelName'] = $modelName;
        $self['providerOptions'] = $providerOptions;

        null !== $apiKey && $self['apiKey'] = $apiKey;
        null !== $baseURL && $self['baseURL'] = $baseURL;
        null !== $headers && $self['headers'] = $headers;

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
     * Azure OpenAI model provider.
     *
     * @param 'azure' $provider
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Azure provider-specific model configuration.
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
