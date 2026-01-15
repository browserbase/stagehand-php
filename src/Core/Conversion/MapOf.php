<?php

declare(strict_types=1);

namespace StagehandSDK\Core\Conversion;

use StagehandSDK\Core\Conversion\Concerns\ArrayOf;
use StagehandSDK\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
