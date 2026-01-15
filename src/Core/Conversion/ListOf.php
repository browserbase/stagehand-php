<?php

declare(strict_types=1);

namespace StagehandSDK\Core\Conversion;

use StagehandSDK\Core\Conversion\Concerns\ArrayOf;
use StagehandSDK\Core\Conversion\Contracts\Converter;

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
