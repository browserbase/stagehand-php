<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions;

use StagehandSDK\Core\Concerns\SdkUnion;
use StagehandSDK\Core\Conversion\Contracts\Converter;
use StagehandSDK\Core\Conversion\Contracts\ConverterSource;
use StagehandSDK\Sessions\ModelConfig\ModelConfigObject;

/**
 * Model name string with provider prefix (e.g., 'openai/gpt-5-nano', 'anthropic/claude-4.5-opus').
 *
 * @phpstan-import-type ModelConfigObjectShape from \StagehandSDK\Sessions\ModelConfig\ModelConfigObject
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
