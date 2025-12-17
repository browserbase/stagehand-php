<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Core\Conversion\ListOf;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1;

/**
 * @phpstan-import-type UnionMember1Shape from \Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1
 *
 * @phpstan-type ProxiesShape = bool|list<UnionMember1Shape>
 */
final class Proxies implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['bool', new ListOf(UnionMember1::class)];
    }
}
