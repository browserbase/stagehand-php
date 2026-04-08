<?php

declare(strict_types=1);

namespace Stagehand\Sessions\ModelConfig\ProviderOptions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig\ProviderOptions\GoogleVertexProviderOptions\GoogleAuthOptions;

/**
 * @phpstan-import-type GoogleAuthOptionsShape from \Stagehand\Sessions\ModelConfig\ProviderOptions\GoogleVertexProviderOptions\GoogleAuthOptions
 *
 * @phpstan-type GoogleVertexProviderOptionsShape = array{
 *   googleAuthOptions?: null|GoogleAuthOptions|GoogleAuthOptionsShape,
 *   headers?: array<string,string>|null,
 *   location?: string|null,
 *   project?: string|null,
 * }
 */
final class GoogleVertexProviderOptions implements BaseModel
{
    /** @use SdkModel<GoogleVertexProviderOptionsShape> */
    use SdkModel;

    /**
     * Optional Google auth options for Vertex AI.
     */
    #[Optional]
    public ?GoogleAuthOptions $googleAuthOptions;

    /**
     * Custom headers for Vertex AI requests.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string')]
    public ?array $headers;

    /**
     * Google Cloud location for Vertex AI.
     */
    #[Optional]
    public ?string $location;

    /**
     * Google Cloud project ID for Vertex AI.
     */
    #[Optional]
    public ?string $project;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param GoogleAuthOptions|GoogleAuthOptionsShape|null $googleAuthOptions
     * @param array<string,string>|null $headers
     */
    public static function with(
        GoogleAuthOptions|array|null $googleAuthOptions = null,
        ?array $headers = null,
        ?string $location = null,
        ?string $project = null,
    ): self {
        $self = new self;

        null !== $googleAuthOptions && $self['googleAuthOptions'] = $googleAuthOptions;
        null !== $headers && $self['headers'] = $headers;
        null !== $location && $self['location'] = $location;
        null !== $project && $self['project'] = $project;

        return $self;
    }

    /**
     * Optional Google auth options for Vertex AI.
     *
     * @param GoogleAuthOptions|GoogleAuthOptionsShape $googleAuthOptions
     */
    public function withGoogleAuthOptions(
        GoogleAuthOptions|array $googleAuthOptions
    ): self {
        $self = clone $this;
        $self['googleAuthOptions'] = $googleAuthOptions;

        return $self;
    }

    /**
     * Custom headers for Vertex AI requests.
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
     * Google Cloud location for Vertex AI.
     */
    public function withLocation(string $location): self
    {
        $self = clone $this;
        $self['location'] = $location;

        return $self;
    }

    /**
     * Google Cloud project ID for Vertex AI.
     */
    public function withProject(string $project): self
    {
        $self = clone $this;
        $self['project'] = $project;

        return $self;
    }
}
