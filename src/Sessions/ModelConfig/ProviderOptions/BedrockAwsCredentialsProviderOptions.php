<?php

declare(strict_types=1);

namespace Stagehand\Sessions\ModelConfig\ProviderOptions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type BedrockAwsCredentialsProviderOptionsShape = array{
 *   accessKeyID: string,
 *   region: string,
 *   secretAccessKey: string,
 *   sessionToken?: string|null,
 * }
 */
final class BedrockAwsCredentialsProviderOptions implements BaseModel
{
    /** @use SdkModel<BedrockAwsCredentialsProviderOptionsShape> */
    use SdkModel;

    /**
     * AWS access key ID for Bedrock.
     */
    #[Required('accessKeyId')]
    public string $accessKeyID;

    /**
     * AWS region for Amazon Bedrock.
     */
    #[Required]
    public string $region;

    /**
     * AWS secret access key for Bedrock.
     */
    #[Required]
    public string $secretAccessKey;

    /**
     * Optional AWS session token for temporary credentials.
     */
    #[Optional]
    public ?string $sessionToken;

    /**
     * `new BedrockAwsCredentialsProviderOptions()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BedrockAwsCredentialsProviderOptions::with(
     *   accessKeyID: ..., region: ..., secretAccessKey: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BedrockAwsCredentialsProviderOptions)
     *   ->withAccessKeyID(...)
     *   ->withRegion(...)
     *   ->withSecretAccessKey(...)
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
     */
    public static function with(
        string $accessKeyID,
        string $region,
        string $secretAccessKey,
        ?string $sessionToken = null,
    ): self {
        $self = new self;

        $self['accessKeyID'] = $accessKeyID;
        $self['region'] = $region;
        $self['secretAccessKey'] = $secretAccessKey;

        null !== $sessionToken && $self['sessionToken'] = $sessionToken;

        return $self;
    }

    /**
     * AWS access key ID for Bedrock.
     */
    public function withAccessKeyID(string $accessKeyID): self
    {
        $self = clone $this;
        $self['accessKeyID'] = $accessKeyID;

        return $self;
    }

    /**
     * AWS region for Amazon Bedrock.
     */
    public function withRegion(string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }

    /**
     * AWS secret access key for Bedrock.
     */
    public function withSecretAccessKey(string $secretAccessKey): self
    {
        $self = clone $this;
        $self['secretAccessKey'] = $secretAccessKey;

        return $self;
    }

    /**
     * Optional AWS session token for temporary credentials.
     */
    public function withSessionToken(string $sessionToken): self
    {
        $self = clone $this;
        $self['sessionToken'] = $sessionToken;

        return $self;
    }
}
