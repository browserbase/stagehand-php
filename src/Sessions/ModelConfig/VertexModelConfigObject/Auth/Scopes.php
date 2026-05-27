<?php

declare(strict_types=1);

namespace Stagehand\Sessions\ModelConfig\VertexModelConfigObject\Auth;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Core\Conversion\ListOf;

/**
 * Google auth scopes for the desired API request.
 *
 * @phpstan-type ScopesVariants = string|list<string>
 * @phpstan-type ScopesShape = ScopesVariants
 */
final class Scopes implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', new ListOf('string')];
    }
}
