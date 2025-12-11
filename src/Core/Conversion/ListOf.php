<?php

declare(strict_types=1);

namespace Stagehand\Core\Conversion;

use Stagehand\Core\Conversion\Concerns\ArrayOf;
use Stagehand\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}
