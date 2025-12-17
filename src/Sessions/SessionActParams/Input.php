<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionActParams;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\SessionActParams\Input\ActionInput;

/**
 * Natural language instruction or Action object.
 *
 * @phpstan-import-type ActionInputShape from \Stagehand\Sessions\SessionActParams\Input\ActionInput
 *
 * @phpstan-type InputShape = string|ActionInputShape
 */
final class Input implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', ActionInput::class];
    }
}
