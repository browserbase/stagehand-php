<?php

declare(strict_types=1);

namespace Stagehand\Sessions\ModelConfig\ProviderOptions\GoogleVertexProviderOptions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\ModelConfig\ProviderOptions\GoogleVertexProviderOptions\GoogleAuthOptions\Credentials;

/**
 * Optional Google auth options for Vertex AI.
 *
 * @phpstan-import-type CredentialsShape from \Stagehand\Sessions\ModelConfig\ProviderOptions\GoogleVertexProviderOptions\GoogleAuthOptions\Credentials
 *
 * @phpstan-type GoogleAuthOptionsShape = array{
 *   credentials?: null|Credentials|CredentialsShape
 * }
 */
final class GoogleAuthOptions implements BaseModel
{
    /** @use SdkModel<GoogleAuthOptionsShape> */
    use SdkModel;

    #[Optional]
    public ?Credentials $credentials;

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
     */
    public static function with(Credentials|array|null $credentials = null): self
    {
        $self = new self;

        null !== $credentials && $self['credentials'] = $credentials;

        return $self;
    }

    /**
     * @param Credentials|CredentialsShape $credentials
     */
    public function withCredentials(Credentials|array $credentials): self
    {
        $self = clone $this;
        $self['credentials'] = $credentials;

        return $self;
    }
}
