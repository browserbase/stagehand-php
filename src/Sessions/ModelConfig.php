<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\ModelConfig\ModelConfigObject;

/**
 * Model name string with provider prefix. Always use the format 'provider/model-name' (e.g., 'openai/gpt-4o', 'anthropic/claude-sonnet-4-5-20250929', 'google/gemini-2.0-flash').
 *
 * @phpstan-import-type ModelConfigObjectShape from \Stagehand\Sessions\ModelConfig\ModelConfigObject
 *
 * @phpstan-type ModelConfigVariants = string|ModelConfigObject
 * @phpstan-type ModelConfigShape = ModelConfigVariants|ModelConfigObjectShape
 */
final class ModelConfig implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', ModelConfigObject::class];
    }
}
