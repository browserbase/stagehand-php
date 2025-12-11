<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Core\Conversion\MapOf;
use Stagehand\Sessions\SessionExtractResponse\Extraction;

/**
 * Default extraction result.
 */
final class SessionExtractResponse implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [Extraction::class, new MapOf('mixed')];
    }
}
