<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\SessionStartParams\ModelClientOptions\BedrockAPIKeyModelClientOptions;
use Stagehand\Sessions\SessionStartParams\ModelClientOptions\BedrockAwsCredentialsModelClientOptions;
use Stagehand\Sessions\SessionStartParams\ModelClientOptions\GenericModelClientOptions;

/**
 * Optional provider-specific configuration for the session model (for example Bedrock region and credentials).
 *
 * @phpstan-import-type BedrockAPIKeyModelClientOptionsShape from \Stagehand\Sessions\SessionStartParams\ModelClientOptions\BedrockAPIKeyModelClientOptions
 * @phpstan-import-type BedrockAwsCredentialsModelClientOptionsShape from \Stagehand\Sessions\SessionStartParams\ModelClientOptions\BedrockAwsCredentialsModelClientOptions
 * @phpstan-import-type GenericModelClientOptionsShape from \Stagehand\Sessions\SessionStartParams\ModelClientOptions\GenericModelClientOptions
 *
 * @phpstan-type ModelClientOptionsVariants = BedrockAPIKeyModelClientOptions|BedrockAwsCredentialsModelClientOptions|GenericModelClientOptions
 * @phpstan-type ModelClientOptionsShape = ModelClientOptionsVariants|BedrockAPIKeyModelClientOptionsShape|BedrockAwsCredentialsModelClientOptionsShape|GenericModelClientOptionsShape
 */
final class ModelClientOptions implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            BedrockAPIKeyModelClientOptions::class,
            BedrockAwsCredentialsModelClientOptions::class,
            GenericModelClientOptions::class,
        ];
    }
}
