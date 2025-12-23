<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteResponse\Data\Result;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type UsageShape = array{
 *   inferenceTimeMs: float,
 *   inputTokens: float,
 *   outputTokens: float,
 *   cachedInputTokens?: float|null,
 *   reasoningTokens?: float|null,
 * }
 */
final class Usage implements BaseModel
{
    /** @use SdkModel<UsageShape> */
    use SdkModel;

    #[Required('inference_time_ms')]
    public float $inferenceTimeMs;

    #[Required('input_tokens')]
    public float $inputTokens;

    #[Required('output_tokens')]
    public float $outputTokens;

    #[Optional('cached_input_tokens')]
    public ?float $cachedInputTokens;

    #[Optional('reasoning_tokens')]
    public ?float $reasoningTokens;

    /**
     * `new Usage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Usage::with(inferenceTimeMs: ..., inputTokens: ..., outputTokens: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Usage)
     *   ->withInferenceTimeMs(...)
     *   ->withInputTokens(...)
     *   ->withOutputTokens(...)
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
        float $inferenceTimeMs,
        float $inputTokens,
        float $outputTokens,
        ?float $cachedInputTokens = null,
        ?float $reasoningTokens = null,
    ): self {
        $self = new self;

        $self['inferenceTimeMs'] = $inferenceTimeMs;
        $self['inputTokens'] = $inputTokens;
        $self['outputTokens'] = $outputTokens;

        null !== $cachedInputTokens && $self['cachedInputTokens'] = $cachedInputTokens;
        null !== $reasoningTokens && $self['reasoningTokens'] = $reasoningTokens;

        return $self;
    }

    public function withInferenceTimeMs(float $inferenceTimeMs): self
    {
        $self = clone $this;
        $self['inferenceTimeMs'] = $inferenceTimeMs;

        return $self;
    }

    public function withInputTokens(float $inputTokens): self
    {
        $self = clone $this;
        $self['inputTokens'] = $inputTokens;

        return $self;
    }

    public function withOutputTokens(float $outputTokens): self
    {
        $self = clone $this;
        $self['outputTokens'] = $outputTokens;

        return $self;
    }

    public function withCachedInputTokens(float $cachedInputTokens): self
    {
        $self = clone $this;
        $self['cachedInputTokens'] = $cachedInputTokens;

        return $self;
    }

    public function withReasoningTokens(float $reasoningTokens): self
    {
        $self = clone $this;
        $self['reasoningTokens'] = $reasoningTokens;

        return $self;
    }
}
