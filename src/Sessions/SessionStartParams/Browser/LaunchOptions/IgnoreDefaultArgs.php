<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\Browser\LaunchOptions;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Core\Conversion\ListOf;

/**
 * @phpstan-type IgnoreDefaultArgsShape = bool|list<string>
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
