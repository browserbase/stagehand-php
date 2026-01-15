<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\SessionStartParams\Browser\LaunchOptions;

use StagehandSDK\Core\Concerns\SdkUnion;
use StagehandSDK\Core\Conversion\Contracts\Converter;
use StagehandSDK\Core\Conversion\Contracts\ConverterSource;
use StagehandSDK\Core\Conversion\ListOf;

/**
 * @phpstan-type IgnoreDefaultArgsVariants = bool|list<string>
 * @phpstan-type IgnoreDefaultArgsShape = IgnoreDefaultArgsVariants
 */
final class IgnoreDefaultArgs implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['bool', new ListOf('string')];
    }
}
