<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionReplayResponse\Data\Page\Action;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type TokenUsageShape = array{
 *   cost?: float|null,
 *   inputTokens?: float|null,
 *   outputTokens?: float|null,
 *   timeMs?: float|null,
 * }
 */
final class TokenUsage implements BaseModel
{
    /** @use SdkModel<TokenUsageShape> */
    use SdkModel;

    #[Optional]
    public ?float $cost;

    #[Optional]
    public ?float $inputTokens;

    #[Optional]
    public ?float $outputTokens;

    #[Optional]
    public ?float $timeMs;

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
        ?float $cost = null,
        ?float $inputTokens = null,
        ?float $outputTokens = null,
        ?float $timeMs = null,
    ): self {
        $self = new self;

        null !== $cost && $self['cost'] = $cost;
        null !== $inputTokens && $self['inputTokens'] = $inputTokens;
        null !== $outputTokens && $self['outputTokens'] = $outputTokens;
        null !== $timeMs && $self['timeMs'] = $timeMs;

        return $self;
    }

    public function withCost(float $cost): self
    {
        $self = clone $this;
        $self['cost'] = $cost;

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

    public function withTimeMs(float $timeMs): self
    {
        $self = clone $this;
        $self['timeMs'] = $timeMs;

        return $self;
    }
}
