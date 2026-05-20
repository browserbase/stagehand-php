<?php

declare(strict_types=1);

namespace Stagehand\Sessions\ModelConfig\GoogleAuthOptions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig\GoogleAuthOptions\Credentials\Type;

/**
 * Google Cloud service account credentials.
 *
 * @phpstan-type CredentialsShape = array{
 *   clientEmail: string,
 *   privateKey: string,
 *   authProviderX509CertURL?: string|null,
 *   authUri?: string|null,
 *   clientID?: string|null,
 *   clientX509CertURL?: string|null,
 *   privateKeyID?: string|null,
 *   projectID?: string|null,
 *   tokenUri?: string|null,
 *   type?: null|Type|value-of<Type>,
 *   universeDomain?: string|null,
 * }
 */
final class Credentials implements BaseModel
{
    /** @use SdkModel<CredentialsShape> */
    use SdkModel;

    #[Required('client_email')]
    public string $clientEmail;

    #[Required('private_key')]
    public string $privateKey;

    #[Optional('auth_provider_x509_cert_url')]
    public ?string $authProviderX509CertURL;

    #[Optional('auth_uri')]
    public ?string $authUri;

    #[Optional('client_id')]
    public ?string $clientID;

    #[Optional('client_x509_cert_url')]
    public ?string $clientX509CertURL;

    #[Optional('private_key_id')]
    public ?string $privateKeyID;

    #[Optional('project_id')]
    public ?string $projectID;

    #[Optional('token_uri')]
    public ?string $tokenUri;

    /** @var value-of<Type>|null $type */
    #[Optional(enum: Type::class)]
    public ?string $type;

    #[Optional('universe_domain')]
    public ?string $universeDomain;

    /**
     * `new Credentials()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Credentials::with(clientEmail: ..., privateKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Credentials)->withClientEmail(...)->withPrivateKey(...)
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
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $clientEmail,
        string $privateKey,
        ?string $authProviderX509CertURL = null,
        ?string $authUri = null,
        ?string $clientID = null,
        ?string $clientX509CertURL = null,
        ?string $privateKeyID = null,
        ?string $projectID = null,
        ?string $tokenUri = null,
        Type|string|null $type = null,
        ?string $universeDomain = null,
    ): self {
        $self = new self;

        $self['clientEmail'] = $clientEmail;
        $self['privateKey'] = $privateKey;

        null !== $authProviderX509CertURL && $self['authProviderX509CertURL'] = $authProviderX509CertURL;
        null !== $authUri && $self['authUri'] = $authUri;
        null !== $clientID && $self['clientID'] = $clientID;
        null !== $clientX509CertURL && $self['clientX509CertURL'] = $clientX509CertURL;
        null !== $privateKeyID && $self['privateKeyID'] = $privateKeyID;
        null !== $projectID && $self['projectID'] = $projectID;
        null !== $tokenUri && $self['tokenUri'] = $tokenUri;
        null !== $type && $self['type'] = $type;
        null !== $universeDomain && $self['universeDomain'] = $universeDomain;

        return $self;
    }

    public function withClientEmail(string $clientEmail): self
    {
        $self = clone $this;
        $self['clientEmail'] = $clientEmail;

        return $self;
    }

    public function withPrivateKey(string $privateKey): self
    {
        $self = clone $this;
        $self['privateKey'] = $privateKey;

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

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
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
