<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionActParams\Options\Model\VertexModelConfigObject;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionActParams\Options\Model\VertexModelConfigObject\Auth\Credentials;
use Stagehand\Sessions\SessionActParams\Options\Model\VertexModelConfigObject\Auth\Scopes;

/**
 * Vertex provider authentication configuration.
 *
 * @phpstan-import-type ScopesVariants from \Stagehand\Sessions\SessionActParams\Options\Model\VertexModelConfigObject\Auth\Scopes
 * @phpstan-import-type CredentialsShape from \Stagehand\Sessions\SessionActParams\Options\Model\VertexModelConfigObject\Auth\Credentials
 * @phpstan-import-type ScopesShape from \Stagehand\Sessions\SessionActParams\Options\Model\VertexModelConfigObject\Auth\Scopes
 *
 * @phpstan-type AuthShape = array{
 *   credentials: Credentials|CredentialsShape,
 *   type: 'googleServiceAccount',
 *   projectID?: string|null,
 *   scopes?: ScopesShape|null,
 *   universeDomain?: string|null,
 * }
 */
final class Auth implements BaseModel
{
    /** @use SdkModel<AuthShape> */
    use SdkModel;

    /**
     * Use inline Google Cloud service account credentials for provider authentication.
     *
     * @var 'googleServiceAccount' $type
     */
    #[Required]
    public string $type = 'googleServiceAccount';

    /**
     * Google Cloud service account credentials.
     */
    #[Required]
    public Credentials $credentials;

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

    /**
     * `new Auth()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Auth::with(credentials: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Auth)->withCredentials(...)
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
     * @param Credentials|CredentialsShape $credentials
     * @param ScopesShape|null $scopes
     */
    public static function with(
        Credentials|array $credentials,
        ?string $projectID = null,
        string|array|null $scopes = null,
        ?string $universeDomain = null,
    ): self {
        $self = new self;

        $self['credentials'] = $credentials;

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
     * Use inline Google Cloud service account credentials for provider authentication.
     *
     * @param 'googleServiceAccount' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

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
