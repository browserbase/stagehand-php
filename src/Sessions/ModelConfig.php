<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\ModelConfig\GenericModelConfigObject;
use Stagehand\Sessions\ModelConfig\VertexModelConfigObject;

/**
 * @phpstan-import-type VertexModelConfigObjectShape from \Stagehand\Sessions\ModelConfig\VertexModelConfigObject
 * @phpstan-import-type GenericModelConfigObjectShape from \Stagehand\Sessions\ModelConfig\GenericModelConfigObject
 *
 * @phpstan-type ModelConfigVariants = VertexModelConfigObject|GenericModelConfigObject
 * @phpstan-type ModelConfigShape = ModelConfigVariants|VertexModelConfigObjectShape|GenericModelConfigObjectShape
 */
final class ModelConfig implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [VertexModelConfigObject::class, GenericModelConfigObject::class];
    }
}
