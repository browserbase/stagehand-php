<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionReplayResponse\Data\Page;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionReplayResponse\Data\Page\Action\TokenUsage;

/**
 * @phpstan-import-type TokenUsageShape from \Stagehand\Sessions\SessionReplayResponse\Data\Page\Action\TokenUsage
 *
 * @phpstan-type ActionShape = array{
 *   method?: string|null, tokenUsage?: null|TokenUsage|TokenUsageShape
 * }
 */
final class Action implements BaseModel
{
    /** @use SdkModel<ActionShape> */
    use SdkModel;

    #[Optional]
    public ?string $method;

    #[Optional]
    public ?TokenUsage $tokenUsage;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param TokenUsage|TokenUsageShape|null $tokenUsage
     */
    public static function with(
        ?string $method = null,
        TokenUsage|array|null $tokenUsage = null
    ): self {
        $self = new self;

        null !== $method && $self['method'] = $method;
        null !== $tokenUsage && $self['tokenUsage'] = $tokenUsage;

        return $self;
    }

    public function withMethod(string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }

    /**
     * @param TokenUsage|TokenUsageShape $tokenUsage
     */
    public function withTokenUsage(TokenUsage|array $tokenUsage): self
    {
        $self = clone $this;
        $self['tokenUsage'] = $tokenUsage;

        return $self;
    }
}
