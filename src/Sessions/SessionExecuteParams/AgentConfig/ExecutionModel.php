<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteParams\AgentConfig;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\ModelConfig;

/**
 * Model configuration object or model name string (e.g., 'openai/gpt-5-nano') for tool execution (observe/act calls within agent tools). If not specified, inherits from the main model configuration.
 *
 * @phpstan-import-type ModelConfigShape from \Stagehand\Sessions\ModelConfig
 *
 * @phpstan-type ExecutionModelVariants = string|ModelConfig
 * @phpstan-type ExecutionModelShape = ExecutionModelVariants|ModelConfigShape
 */
final class ExecutionModel implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [ModelConfig::class, 'string'];
    }
}
