<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\SessionActParams;

use StagehandSDK\Core\Concerns\SdkUnion;
use StagehandSDK\Core\Conversion\Contracts\Converter;
use StagehandSDK\Core\Conversion\Contracts\ConverterSource;
use StagehandSDK\Sessions\Action;

/**
 * Natural language instruction or Action object.
 *
 * @phpstan-import-type ActionShape from \StagehandSDK\Sessions\Action
 *
 * @phpstan-type InputVariants = string|Action
 * @phpstan-type InputShape = InputVariants|ActionShape
 */
final class Input implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', Action::class];
    }
}
