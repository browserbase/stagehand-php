<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList\BrowserbaseProxyConfig;
use Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList\ExternalProxyConfig;

/**
 * @phpstan-import-type BrowserbaseProxyConfigShape from \Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList\BrowserbaseProxyConfig
 * @phpstan-import-type ExternalProxyConfigShape from \Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList\ExternalProxyConfig
 *
 * @phpstan-type ProxyConfigListShape = BrowserbaseProxyConfigShape|ExternalProxyConfigShape
 */
final class ProxyConfigList implements ConverterSource
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
