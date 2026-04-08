<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\ModelClientOptions\GenericModelClientOptions\ProviderOptions\GoogleVertexProviderOptions\GoogleAuthOptions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type CredentialsShape = array{
 *   authProviderX509CertURL?: string|null,
 *   authUri?: string|null,
 *   clientEmail?: string|null,
 *   clientID?: string|null,
 *   clientX509CertURL?: string|null,
 *   privateKey?: string|null,
 *   privateKeyID?: string|null,
 *   projectID?: string|null,
 *   tokenUri?: string|null,
 *   type?: string|null,
 *   universeDomain?: string|null,
 * }
 */
final class Credentials implements BaseModel
{
    /** @use SdkModel<CredentialsShape> */
    use SdkModel;

    #[Optional('auth_provider_x509_cert_url')]
    public ?string $authProviderX509CertURL;

    #[Optional('auth_uri')]
    public ?string $authUri;

    #[Optional('client_email')]
    public ?string $clientEmail;

    #[Optional('client_id')]
    public ?string $clientID;

    #[Optional('client_x509_cert_url')]
    public ?string $clientX509CertURL;

    #[Optional('private_key')]
    public ?string $privateKey;

    #[Optional('private_key_id')]
    public ?string $privateKeyID;

    #[Optional('project_id')]
    public ?string $projectID;

    #[Optional('token_uri')]
    public ?string $tokenUri;

    #[Optional]
    public ?string $type;

    #[Optional('universe_domain')]
    public ?string $universeDomain;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $authProviderX509CertURL = null,
        ?string $authUri = null,
        ?string $clientEmail = null,
        ?string $clientID = null,
        ?string $clientX509CertURL = null,
        ?string $privateKey = null,
        ?string $privateKeyID = null,
        ?string $projectID = null,
        ?string $tokenUri = null,
        ?string $type = null,
        ?string $universeDomain = null,
    ): self {
        $self = new self;

        null !== $authProviderX509CertURL && $self['authProviderX509CertURL'] = $authProviderX509CertURL;
        null !== $authUri && $self['authUri'] = $authUri;
        null !== $clientEmail && $self['clientEmail'] = $clientEmail;
        null !== $clientID && $self['clientID'] = $clientID;
        null !== $clientX509CertURL && $self['clientX509CertURL'] = $clientX509CertURL;
        null !== $privateKey && $self['privateKey'] = $privateKey;
        null !== $privateKeyID && $self['privateKeyID'] = $privateKeyID;
        null !== $projectID && $self['projectID'] = $projectID;
        null !== $tokenUri && $self['tokenUri'] = $tokenUri;
        null !== $type && $self['type'] = $type;
        null !== $universeDomain && $self['universeDomain'] = $universeDomain;

        return $self;
    }

    public function withAuthProviderX509CertURL(
        string $authProviderX509CertURL
    ): self {
        $self = clone $this;
        $self['authProviderX509CertURL'] = $authProviderX509CertURL;

        return $self;
    }

    public function withAuthUri(string $authUri): self
    {
        $self = clone $this;
        $self['authUri'] = $authUri;

        return $self;
    }

    public function withClientEmail(string $clientEmail): self
    {
        $self = clone $this;
        $self['clientEmail'] = $clientEmail;

        return $self;
    }

    public function withClientID(string $clientID): self
    {
        $self = clone $this;
        $self['clientID'] = $clientID;

        return $self;
    }

    public function withClientX509CertURL(string $clientX509CertURL): self
    {
        $self = clone $this;
        $self['clientX509CertURL'] = $clientX509CertURL;

        return $self;
    }

    public function withPrivateKey(string $privateKey): self
    {
        $self = clone $this;
        $self['privateKey'] = $privateKey;

        return $self;
    }

    public function withPrivateKeyID(string $privateKeyID): self
    {
        $self = clone $this;
        $self['privateKeyID'] = $privateKeyID;

        return $self;
    }

    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    public function withTokenUri(string $tokenUri): self
    {
        $self = clone $this;
        $self['tokenUri'] = $tokenUri;

        return $self;
    }

    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withUniverseDomain(string $universeDomain): self
    {
        $self = clone $this;
        $self['universeDomain'] = $universeDomain;

        return $self;
    }
}
