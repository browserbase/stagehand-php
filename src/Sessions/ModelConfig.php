<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\ModelConfig\AzureAPIKeyModelConfigObject;
use Stagehand\Sessions\ModelConfig\AzureEntraModelConfigObject;
use Stagehand\Sessions\ModelConfig\GenericModelConfigObject;
use Stagehand\Sessions\ModelConfig\VertexModelConfigObject;

/**
 * @phpstan-import-type VertexModelConfigObjectShape from \Stagehand\Sessions\ModelConfig\VertexModelConfigObject
 * @phpstan-import-type AzureEntraModelConfigObjectShape from \Stagehand\Sessions\ModelConfig\AzureEntraModelConfigObject
 * @phpstan-import-type AzureAPIKeyModelConfigObjectShape from \Stagehand\Sessions\ModelConfig\AzureAPIKeyModelConfigObject
 * @phpstan-import-type GenericModelConfigObjectShape from \Stagehand\Sessions\ModelConfig\GenericModelConfigObject
 *
 * @phpstan-type ModelConfigVariants = VertexModelConfigObject|AzureEntraModelConfigObject|AzureAPIKeyModelConfigObject|GenericModelConfigObject
 * @phpstan-type ModelConfigShape = ModelConfigVariants|VertexModelConfigObjectShape|AzureEntraModelConfigObjectShape|AzureAPIKeyModelConfigObjectShape|GenericModelConfigObjectShape
 */
final class ModelConfig implements ConverterSource
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
        ];
    }
}
