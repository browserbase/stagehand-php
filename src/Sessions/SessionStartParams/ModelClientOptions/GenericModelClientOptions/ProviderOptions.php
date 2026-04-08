<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\ModelClientOptions\GenericModelClientOptions;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\SessionStartParams\ModelClientOptions\GenericModelClientOptions\ProviderOptions\BedrockAPIKeyProviderOptions;
use Stagehand\Sessions\SessionStartParams\ModelClientOptions\GenericModelClientOptions\ProviderOptions\BedrockAwsCredentialsProviderOptions;
use Stagehand\Sessions\SessionStartParams\ModelClientOptions\GenericModelClientOptions\ProviderOptions\GoogleVertexProviderOptions;

/**
 * Provider-specific options passed through to the AI SDK provider constructor. For Bedrock: { region, accessKeyId, secretAccessKey, sessionToken }. For Vertex: { project, location, googleAuthOptions }.
 *
 * @phpstan-import-type BedrockAPIKeyProviderOptionsShape from \Stagehand\Sessions\SessionStartParams\ModelClientOptions\GenericModelClientOptions\ProviderOptions\BedrockAPIKeyProviderOptions
 * @phpstan-import-type BedrockAwsCredentialsProviderOptionsShape from \Stagehand\Sessions\SessionStartParams\ModelClientOptions\GenericModelClientOptions\ProviderOptions\BedrockAwsCredentialsProviderOptions
 * @phpstan-import-type GoogleVertexProviderOptionsShape from \Stagehand\Sessions\SessionStartParams\ModelClientOptions\GenericModelClientOptions\ProviderOptions\GoogleVertexProviderOptions
 *
 * @phpstan-type ProviderOptionsVariants = BedrockAPIKeyProviderOptions|BedrockAwsCredentialsProviderOptions|GoogleVertexProviderOptions
 * @phpstan-type ProviderOptionsShape = ProviderOptionsVariants|BedrockAPIKeyProviderOptionsShape|BedrockAwsCredentialsProviderOptionsShape|GoogleVertexProviderOptionsShape
 */
final class ProviderOptions implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            BedrockAPIKeyProviderOptions::class,
            BedrockAwsCredentialsProviderOptions::class,
            GoogleVertexProviderOptions::class,
        ];
    }
}
