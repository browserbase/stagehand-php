<?php

declare(strict_types=1);

namespace Stagehand\Sessions\ModelConfig;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig\GoogleAuthOptions\Credentials;
use Stagehand\Sessions\ModelConfig\GoogleAuthOptions\Scopes;

/**
 * google-auth-library options used to authenticate Vertex AI models.
 *
 * @phpstan-import-type ScopesVariants from \Stagehand\Sessions\ModelConfig\GoogleAuthOptions\Scopes
 * @phpstan-import-type CredentialsShape from \Stagehand\Sessions\ModelConfig\GoogleAuthOptions\Credentials
 * @phpstan-import-type ScopesShape from \Stagehand\Sessions\ModelConfig\GoogleAuthOptions\Scopes
 *
 * @phpstan-type GoogleAuthOptionsShape = array{
 *   credentials?: null|Credentials|CredentialsShape,
 *   projectID?: string|null,
 *   scopes?: ScopesShape|null,
 *   universeDomain?: string|null,
 * }
 */
final class GoogleAuthOptions implements BaseModel
{
    /** @use SdkModel<GoogleAuthOptionsShape> */
    use SdkModel;

    /**
     * Google Cloud service account credentials.
     */
    #[Optional]
    public ?Credentials $credentials;

    /**
     * Google Cloud project ID used by google-auth-library.
     */
    #[Optional('projectId')]
    public ?string $projectID;

    /**
     * Google auth scopes for the desired API request.
     *
     * @var ScopesVariants|null $scopes
     */
    #[Optional(union: Scopes::class)]
    public string|array|null $scopes;

    /**
     * Google Cloud universe domain.
     */
    #[Optional]
    public ?string $universeDomain;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Credentials|CredentialsShape|null $credentials
     * @param ScopesShape|null $scopes
     */
    public static function with(
        Credentials|array|null $credentials = null,
        ?string $projectID = null,
        string|array|null $scopes = null,
        ?string $universeDomain = null,
    ): self {
        $self = new self;

        null !== $credentials && $self['credentials'] = $credentials;
        null !== $projectID && $self['projectID'] = $projectID;
        null !== $scopes && $self['scopes'] = $scopes;
        null !== $universeDomain && $self['universeDomain'] = $universeDomain;

        return $self;
    }

    /**
     * Google Cloud service account credentials.
     *
     * @param Credentials|CredentialsShape $credentials
     */
    public function withCredentials(Credentials|array $credentials): self
    {
        $self = clone $this;
        $self['credentials'] = $credentials;

        return $self;
    }

    /**
     * Google Cloud project ID used by google-auth-library.
     */
    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    /**
     * Google auth scopes for the desired API request.
     *
     * @param ScopesShape $scopes
     */
    public function withScopes(string|array $scopes): self
    {
        $self = clone $this;
        $self['scopes'] = $scopes;

        return $self;
    }

    /**
     * Google Cloud universe domain.
     */
    public function withUniverseDomain(string $universeDomain): self
    {
        $self = clone $this;
        $self['universeDomain'] = $universeDomain;

        return $self;
    }
}
