<?php

declare(strict_types=1);

namespace Stagehand\Sessions\ModelConfig\AzureAPIKeyModelConfigObject\ProviderOptions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * Azure OpenAI provider-specific settings.
 *
 * @phpstan-type AzureShape = array{
 *   apiVersion?: string|null,
 *   baseURL?: string|null,
 *   headers?: array<string,string>|null,
 *   resourceName?: string|null,
 *   useDeploymentBasedURLs?: bool|null,
 * }
 */
final class Azure implements BaseModel
{
    /** @use SdkModel<AzureShape> */
    use SdkModel;

    /**
     * Azure OpenAI API version.
     */
    #[Optional]
    public ?string $apiVersion;

    /**
     * Base URL for the Azure OpenAI provider.
     */
    #[Optional]
    public ?string $baseURL;

    /**
     * Custom headers sent with every request to the Azure OpenAI provider.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string')]
    public ?array $headers;

    /**
     * Azure OpenAI resource name.
     */
    #[Optional]
    public ?string $resourceName;

    /**
     * Whether to use deployment-based Azure OpenAI URLs.
     */
    #[Optional('useDeploymentBasedUrls')]
    public ?bool $useDeploymentBasedURLs;

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
     */
    public static function with(
        ?string $apiVersion = null,
        ?string $baseURL = null,
        ?array $headers = null,
        ?string $resourceName = null,
        ?bool $useDeploymentBasedURLs = null,
    ): self {
        $self = new self;

        null !== $apiVersion && $self['apiVersion'] = $apiVersion;
        null !== $baseURL && $self['baseURL'] = $baseURL;
        null !== $headers && $self['headers'] = $headers;
        null !== $resourceName && $self['resourceName'] = $resourceName;
        null !== $useDeploymentBasedURLs && $self['useDeploymentBasedURLs'] = $useDeploymentBasedURLs;

        return $self;
    }

    /**
     * Azure OpenAI API version.
     */
    public function withAPIVersion(string $apiVersion): self
    {
        $self = clone $this;
        $self['apiVersion'] = $apiVersion;

        return $self;
    }

    /**
     * Base URL for the Azure OpenAI provider.
     */
    public function withBaseURL(string $baseURL): self
    {
        $self = clone $this;
        $self['baseURL'] = $baseURL;

        return $self;
    }

    /**
     * Custom headers sent with every request to the Azure OpenAI provider.
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
     * Azure OpenAI resource name.
     */
    public function withResourceName(string $resourceName): self
    {
        $self = clone $this;
        $self['resourceName'] = $resourceName;

        return $self;
    }

    /**
     * Whether to use deployment-based Azure OpenAI URLs.
     */
    public function withUseDeploymentBasedURLs(
        bool $useDeploymentBasedURLs
    ): self {
        $self = clone $this;
        $self['useDeploymentBasedURLs'] = $useDeploymentBasedURLs;

        return $self;
    }
}
