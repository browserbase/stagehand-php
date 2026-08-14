<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionActParams\Options\Model\AzureAPIKeyModelConfigObject;

use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionActParams\Options\Model\AzureAPIKeyModelConfigObject\ProviderOptions\Azure;

/**
 * Azure provider-specific model configuration.
 *
 * @phpstan-import-type AzureShape from \Stagehand\Sessions\SessionActParams\Options\Model\AzureAPIKeyModelConfigObject\ProviderOptions\Azure
 *
 * @phpstan-type ProviderOptionsShape = array{azure: Azure|AzureShape}
 */
final class ProviderOptions implements BaseModel
{
    /** @use SdkModel<ProviderOptionsShape> */
    use SdkModel;

    /**
     * Azure OpenAI provider-specific settings.
     */
    #[Required]
    public Azure $azure;

    /**
     * `new ProviderOptions()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProviderOptions::with(azure: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProviderOptions)->withAzure(...)
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
     * @param Azure|AzureShape $azure
     */
    public static function with(Azure|array $azure): self
    {
        $self = new self;

        $self['azure'] = $azure;

        return $self;
    }

    /**
     * Azure OpenAI provider-specific settings.
     *
     * @param Azure|AzureShape $azure
     */
    public function withAzure(Azure|array $azure): self
    {
        $self = clone $this;
        $self['azure'] = $azure;

        return $self;
    }
}
