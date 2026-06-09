<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteParams\AgentConfig;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\SessionExecuteParams\AgentConfig\ExecutionModel\AzureAPIKeyModelConfigObject;
use Stagehand\Sessions\SessionExecuteParams\AgentConfig\ExecutionModel\AzureEntraModelConfigObject;
use Stagehand\Sessions\SessionExecuteParams\AgentConfig\ExecutionModel\GenericModelConfigObject;
use Stagehand\Sessions\SessionExecuteParams\AgentConfig\ExecutionModel\VertexModelConfigObject;

/**
 * Model configuration object or model name string (e.g., 'openai/gpt-5-nano') for tool execution (observe/act calls within agent tools). If not specified, inherits from the main model configuration.
 *
 * @phpstan-import-type VertexModelConfigObjectShape from \Stagehand\Sessions\SessionExecuteParams\AgentConfig\ExecutionModel\VertexModelConfigObject
 * @phpstan-import-type AzureEntraModelConfigObjectShape from \Stagehand\Sessions\SessionExecuteParams\AgentConfig\ExecutionModel\AzureEntraModelConfigObject
 * @phpstan-import-type AzureAPIKeyModelConfigObjectShape from \Stagehand\Sessions\SessionExecuteParams\AgentConfig\ExecutionModel\AzureAPIKeyModelConfigObject
 * @phpstan-import-type GenericModelConfigObjectShape from \Stagehand\Sessions\SessionExecuteParams\AgentConfig\ExecutionModel\GenericModelConfigObject
 *
 * @phpstan-type ExecutionModelVariants = string|VertexModelConfigObject|AzureEntraModelConfigObject|AzureAPIKeyModelConfigObject|GenericModelConfigObject
 * @phpstan-type ExecutionModelShape = ExecutionModelVariants|VertexModelConfigObjectShape|AzureEntraModelConfigObjectShape|AzureAPIKeyModelConfigObjectShape|GenericModelConfigObjectShape
 */
final class ExecutionModel implements ConverterSource
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
