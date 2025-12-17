<?php

declare(strict_types=1);

namespace Stagehand\Sessions\ModelConfig;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type ModelConfigObjectShape = array{
 *   modelName: string, apiKey?: string|null, baseURL?: string|null
 * }
 */
final class ModelConfigObject implements BaseModel
{
    /** @use SdkModel<ModelConfigObjectShape> */
    use SdkModel;

    /**
     * Model name string without prefix (e.g., 'gpt-5-nano', 'claude-4.5-opus').
     */
    #[Required]
    public string $modelName;

    /**
     * API key for the model provider.
     */
    #[Optional]
    public ?string $apiKey;

    /**
     * Base URL for the model provider.
     */
    #[Optional]
    public ?string $baseURL;

    /**
     * `new ModelConfigObject()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ModelConfigObject::with(modelName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ModelConfigObject)->withModelName(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $modelName,
        ?string $apiKey = null,
        ?string $baseURL = null
    ): self {
        $self = new self;

        $self['modelName'] = $modelName;

        null !== $apiKey && $self['apiKey'] = $apiKey;
        null !== $baseURL && $self['baseURL'] = $baseURL;

        return $self;
    }

    /**
     * Model name string without prefix (e.g., 'gpt-5-nano', 'claude-4.5-opus').
     */
    public function withModelName(string $modelName): self
    {
        $self = clone $this;
        $self['modelName'] = $modelName;

        return $self;
    }

    /**
     * API key for the model provider.
     */
    public function withAPIKey(string $apiKey): self
    {
        $self = clone $this;
        $self['apiKey'] = $apiKey;

        return $self;
    }

    /**
     * Base URL for the model provider.
     */
    public function withBaseURL(string $baseURL): self
    {
        $self = clone $this;
        $self['baseURL'] = $baseURL;

        return $self;
    }
}
