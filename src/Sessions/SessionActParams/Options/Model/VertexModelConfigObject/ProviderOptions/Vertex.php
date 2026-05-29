<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionActParams\Options\Model\VertexModelConfigObject\ProviderOptions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * Vertex AI provider-specific settings.
 *
 * @phpstan-type VertexShape = array{
 *   location: string,
 *   project: string,
 *   baseURL?: string|null,
 *   headers?: array<string,string>|null,
 * }
 */
final class Vertex implements BaseModel
{
    /** @use SdkModel<VertexShape> */
    use SdkModel;

    /**
     * Google Cloud location for Vertex AI models.
     */
    #[Required]
    public string $location;

    /**
     * Google Cloud project ID for Vertex AI models.
     */
    #[Required]
    public string $project;

    /**
     * Base URL for the Vertex AI provider.
     */
    #[Optional]
    public ?string $baseURL;

    /**
     * Custom headers sent with every request to the Vertex AI provider.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string')]
    public ?array $headers;

    /**
     * `new Vertex()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Vertex::with(location: ..., project: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Vertex)->withLocation(...)->withProject(...)
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
     * @param array<string,string>|null $headers
     */
    public static function with(
        string $location,
        string $project,
        ?string $baseURL = null,
        ?array $headers = null,
    ): self {
        $self = new self;

        $self['location'] = $location;
        $self['project'] = $project;

        null !== $baseURL && $self['baseURL'] = $baseURL;
        null !== $headers && $self['headers'] = $headers;

        return $self;
    }

    /**
     * Google Cloud location for Vertex AI models.
     */
    public function withLocation(string $location): self
    {
        $self = clone $this;
        $self['location'] = $location;

        return $self;
    }

    /**
     * Google Cloud project ID for Vertex AI models.
     */
    public function withProject(string $project): self
    {
        $self = clone $this;
        $self['project'] = $project;

        return $self;
    }

    /**
     * Base URL for the Vertex AI provider.
     */
    public function withBaseURL(string $baseURL): self
    {
        $self = clone $this;
        $self['baseURL'] = $baseURL;

        return $self;
    }

    /**
     * Custom headers sent with every request to the Vertex AI provider.
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
