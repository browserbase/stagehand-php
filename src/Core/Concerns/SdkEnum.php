<?php

declare(strict_types=1);

namespace Stagehand\Core\Concerns;

use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\EnumOf;

/**
 * @internal
 */
trait SdkEnum
{
    private static Converter $converter;

    public static function converter(): Converter
    {
        if (isset(static::$converter)) {
            return static::$converter;
        }

        $class = new \ReflectionClass(static::class);
        $acc = [];
        foreach ($class->getReflectionConstants() as $constant) {
            if ($constant->isPublic()) {
                array_push($acc, $constant->getValue());
            }
        }

        // @phpstan-ignore-next-line return.type
        return static::$converter = new EnumOf($acc);
    }
}
