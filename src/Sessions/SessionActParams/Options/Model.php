<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionActParams\Options;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\SessionActParams\Options\Model\GenericModelConfigObject;
use Stagehand\Sessions\SessionActParams\Options\Model\VertexModelConfigObject;

/**
 * Model configuration object or model name string (e.g., 'openai/gpt-5-nano').
 *
 * @phpstan-import-type VertexModelConfigObjectShape from \Stagehand\Sessions\SessionActParams\Options\Model\VertexModelConfigObject
 * @phpstan-import-type GenericModelConfigObjectShape from \Stagehand\Sessions\SessionActParams\Options\Model\GenericModelConfigObject
 *
 * @phpstan-type ModelVariants = string|VertexModelConfigObject|GenericModelConfigObject
 * @phpstan-type ModelShape = ModelVariants|VertexModelConfigObjectShape|GenericModelConfigObjectShape
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
            VertexModelConfigObject::class, GenericModelConfigObject::class, 'string',
        ];
    }
}
