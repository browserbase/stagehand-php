<?php

declare(strict_types=1);

namespace Stagehand\Sessions\StreamEvent;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\StreamEvent\Data\StreamEventLogDataOutput;
use Stagehand\Sessions\StreamEvent\Data\StreamEventSystemDataOutput;

/**
 * @phpstan-import-type StreamEventSystemDataOutputShape from \Stagehand\Sessions\StreamEvent\Data\StreamEventSystemDataOutput
 * @phpstan-import-type StreamEventLogDataOutputShape from \Stagehand\Sessions\StreamEvent\Data\StreamEventLogDataOutput
 *
 * @phpstan-type DataVariants = StreamEventSystemDataOutput|StreamEventLogDataOutput
 * @phpstan-type DataShape = DataVariants|StreamEventSystemDataOutputShape|StreamEventLogDataOutputShape
 */
final class Data implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            StreamEventSystemDataOutput::class, StreamEventLogDataOutput::class,
        ];
    }
}
