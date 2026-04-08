<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\ModelClientOptions\BedrockAPIKeyModelClientOptions;

use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProviderOptionsShape = array{region: string}
 */
final class ProviderOptions implements BaseModel
{
    /** @use SdkModel<ProviderOptionsShape> */
    use SdkModel;

    /**
     * AWS region for Amazon Bedrock.
     */
    #[Required]
    public string $region;

    /**
     * `new ProviderOptions()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProviderOptions::with(region: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProviderOptions)->withRegion(...)
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
