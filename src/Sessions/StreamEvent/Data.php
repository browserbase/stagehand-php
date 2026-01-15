<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\StreamEvent;

use StagehandSDK\Core\Concerns\SdkUnion;
use StagehandSDK\Core\Conversion\Contracts\Converter;
use StagehandSDK\Core\Conversion\Contracts\ConverterSource;
use StagehandSDK\Sessions\StreamEvent\Data\StreamEventLogDataOutput;
use StagehandSDK\Sessions\StreamEvent\Data\StreamEventSystemDataOutput;

/**
 * @phpstan-import-type StreamEventSystemDataOutputShape from \StagehandSDK\Sessions\StreamEvent\Data\StreamEventSystemDataOutput
 * @phpstan-import-type StreamEventLogDataOutputShape from \StagehandSDK\Sessions\StreamEvent\Data\StreamEventLogDataOutput
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
