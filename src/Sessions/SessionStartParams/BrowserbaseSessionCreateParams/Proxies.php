<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams;

use StagehandSDK\Core\Concerns\SdkUnion;
use StagehandSDK\Core\Conversion\Contracts\Converter;
use StagehandSDK\Core\Conversion\Contracts\ConverterSource;
use StagehandSDK\Core\Conversion\ListOf;
use StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList;
use StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList\BrowserbaseProxyConfig;
use StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList\ExternalProxyConfig;

/**
 * @phpstan-import-type ProxyConfigListShape from \StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\Proxies\ProxyConfigList
 *
 * @phpstan-type ProxiesVariants = bool|list<BrowserbaseProxyConfig|ExternalProxyConfig>
 * @phpstan-type ProxiesShape = ProxiesVariants|list<ProxyConfigListShape>
 */
final class Proxies implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['bool', new ListOf(ProxyConfigList::class)];
    }
}
