<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionObserveParams\Options;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\SessionObserveParams\Options\Variable\UnionMember3;

/**
 * @phpstan-import-type UnionMember3Shape from \Stagehand\Sessions\SessionObserveParams\Options\Variable\UnionMember3
 *
 * @phpstan-type VariableVariants = string|float|bool|UnionMember3
 * @phpstan-type VariableShape = VariableVariants|UnionMember3Shape
 */
final class Variable implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'float', 'bool', UnionMember3::class];
    }
}
