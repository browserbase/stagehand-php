<?php

declare(strict_types=1);

namespace Stagehand\Sessions\ModelConfig;

use Stagehand\Core\Concerns\SdkUnion;
use Stagehand\Core\Conversion\Contracts\Converter;
use Stagehand\Core\Conversion\Contracts\ConverterSource;
use Stagehand\Sessions\ModelConfig\ProviderOptions\BedrockAPIKeyProviderOptions;
use Stagehand\Sessions\ModelConfig\ProviderOptions\BedrockAwsCredentialsProviderOptions;
use Stagehand\Sessions\ModelConfig\ProviderOptions\GoogleVertexProviderOptions;

/**
 * Provider-specific options passed through to the AI SDK provider constructor. For Bedrock: { region, accessKeyId, secretAccessKey, sessionToken }. For Vertex: { project, location, googleAuthOptions }.
 *
 * @phpstan-import-type BedrockAPIKeyProviderOptionsShape from \Stagehand\Sessions\ModelConfig\ProviderOptions\BedrockAPIKeyProviderOptions
 * @phpstan-import-type BedrockAwsCredentialsProviderOptionsShape from \Stagehand\Sessions\ModelConfig\ProviderOptions\BedrockAwsCredentialsProviderOptions
 * @phpstan-import-type GoogleVertexProviderOptionsShape from \Stagehand\Sessions\ModelConfig\ProviderOptions\GoogleVertexProviderOptions
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
