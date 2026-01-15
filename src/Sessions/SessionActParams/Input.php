<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionActParams;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\Action;

/**
 * Natural language instruction or Action object.
 *
 * @phpstan-import-type ActionShape from \Stagehand\Sessions\Action
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
