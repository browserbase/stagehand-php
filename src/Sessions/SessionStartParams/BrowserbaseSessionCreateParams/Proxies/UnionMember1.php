<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1\BrowserbaseProxyConfig;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1\ExternalProxyConfig;

/**
 * @phpstan-import-type BrowserbaseProxyConfigShape from \Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1\BrowserbaseProxyConfig
 * @phpstan-import-type ExternalProxyConfigShape from \Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\UnionMember1\ExternalProxyConfig
 *
 * @phpstan-type UnionMember1Shape = BrowserbaseProxyConfigShape|ExternalProxyConfigShape
 */
final class UnionMember1 implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'type';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'browserbase' => BrowserbaseProxyConfig::class,
            'external' => ExternalProxyConfig::class,
        ];
    }
}
