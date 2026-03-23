<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionActParams\Options\Variable\UnionMember3;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type ValueVariants = string|float|bool
 * @phpstan-type ValueShape = ValueVariants
 */
final class Value implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', 'float', 'bool'];
    }
}
