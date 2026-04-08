<?php

declare(strict_types=1);

namespace Stagehand\Sessions\ModelConfig\ProviderOptions;

use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type BedrockAPIKeyProviderOptionsShape = array{region: string}
 */
final class BedrockAPIKeyProviderOptions implements BaseModel
{
    /** @use SdkModel<BedrockAPIKeyProviderOptionsShape> */
    use SdkModel;

    /**
     * AWS region for Amazon Bedrock.
     */
    #[Required]
    public string $region;

    /**
     * `new BedrockAPIKeyProviderOptions()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BedrockAPIKeyProviderOptions::with(region: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BedrockAPIKeyProviderOptions)->withRegion(...)
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
    public static function with(string $region): self
    {
        $self = new self;

        $self['region'] = $region;

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
}
