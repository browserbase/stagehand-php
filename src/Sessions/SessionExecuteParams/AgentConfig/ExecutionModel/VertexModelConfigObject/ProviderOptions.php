<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteParams\AgentConfig\ExecutionModel\VertexModelConfigObject;

use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionExecuteParams\AgentConfig\ExecutionModel\VertexModelConfigObject\ProviderOptions\Vertex;

/**
 * Vertex provider-specific model configuration.
 *
 * @phpstan-import-type VertexShape from \Stagehand\Sessions\SessionExecuteParams\AgentConfig\ExecutionModel\VertexModelConfigObject\ProviderOptions\Vertex
 *
 * @phpstan-type ProviderOptionsShape = array{vertex: Vertex|VertexShape}
 */
final class ProviderOptions implements BaseModel
{
    /** @use SdkModel<ProviderOptionsShape> */
    use SdkModel;

    /**
     * Vertex AI provider-specific settings.
     */
    #[Required]
    public Vertex $vertex;

    /**
     * `new ProviderOptions()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProviderOptions::with(vertex: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProviderOptions)->withVertex(...)
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
     *
     * @param Vertex|VertexShape $vertex
     */
    public static function with(Vertex|array $vertex): self
    {
        $self = new self;

        $self['vertex'] = $vertex;

        return $self;
    }

    /**
     * Vertex AI provider-specific settings.
     *
     * @param Vertex|VertexShape $vertex
     */
    public function withVertex(Vertex|array $vertex): self
    {
        $self = clone $this;
        $self['vertex'] = $vertex;

        return $self;
    }
}
