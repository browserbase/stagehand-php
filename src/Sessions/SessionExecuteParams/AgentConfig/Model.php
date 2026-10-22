<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteParams\AgentConfig;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\SessionExecuteParams\AgentConfig\Model\AzureAPIKeyModelConfigObject;
use Stagehand\Sessions\SessionExecuteParams\AgentConfig\Model\AzureEntraModelConfigObject;
use Stagehand\Sessions\SessionExecuteParams\AgentConfig\Model\GenericModelConfigObject;
use Stagehand\Sessions\SessionExecuteParams\AgentConfig\Model\VertexModelConfigObject;

/**
 * Model configuration object or model name string (e.g., 'openai/gpt-5-nano').
 *
 * @phpstan-import-type VertexModelConfigObjectShape from \Stagehand\Sessions\SessionExecuteParams\AgentConfig\Model\VertexModelConfigObject
 * @phpstan-import-type AzureEntraModelConfigObjectShape from \Stagehand\Sessions\SessionExecuteParams\AgentConfig\Model\AzureEntraModelConfigObject
 * @phpstan-import-type AzureAPIKeyModelConfigObjectShape from \Stagehand\Sessions\SessionExecuteParams\AgentConfig\Model\AzureAPIKeyModelConfigObject
 * @phpstan-import-type GenericModelConfigObjectShape from \Stagehand\Sessions\SessionExecuteParams\AgentConfig\Model\GenericModelConfigObject
 *
 * @phpstan-type ModelVariants = string|VertexModelConfigObject|AzureEntraModelConfigObject|AzureAPIKeyModelConfigObject|GenericModelConfigObject
 * @phpstan-type ModelShape = ModelVariants|VertexModelConfigObjectShape|AzureEntraModelConfigObjectShape|AzureAPIKeyModelConfigObjectShape|GenericModelConfigObjectShape
 */
final class Model implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            VertexModelConfigObject::class,
            AzureEntraModelConfigObject::class,
            AzureAPIKeyModelConfigObject::class,
            GenericModelConfigObject::class,
            'string',
        ];
    }
}
