<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies;

use StagehandSDK\Core\Concerns\SdkUnion;
use StagehandSDK\Core\Conversion\Contracts\Converter;
use StagehandSDK\Core\Conversion\Contracts\ConverterSource;
use StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList\BrowserbaseProxyConfig;
use StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList\ExternalProxyConfig;

/**
 * @phpstan-import-type BrowserbaseProxyConfigShape from \StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList\BrowserbaseProxyConfig
 * @phpstan-import-type ExternalProxyConfigShape from \StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList\ExternalProxyConfig
 *
 * @phpstan-type ProxyConfigListVariants = BrowserbaseProxyConfig|ExternalProxyConfig
 * @phpstan-type ProxyConfigListShape = ProxyConfigListVariants|BrowserbaseProxyConfigShape|ExternalProxyConfigShape
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
