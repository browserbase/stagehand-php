<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExtractParams\Options;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\ModelConfig;

/**
 * Model configuration object or model name string (e.g., 'openai/gpt-5-nano').
 *
 * @phpstan-import-type ModelConfigShape from \Stagehand\Sessions\ModelConfig
 *
 * @phpstan-type ModelVariants = string|ModelConfig
 * @phpstan-type ModelShape = ModelVariants|ModelConfigShape
 */
final class Model implements ConverterSource
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
