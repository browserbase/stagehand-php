<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type SessionExecuteAgentResponseShape = array{
 *   message?: string|null, steps?: list<mixed>|null
 * }
 */
final class SessionExecuteAgentResponse implements BaseModel
{
    /** @use SdkModel<SessionExecuteAgentResponseShape> */
    use SdkModel;

    /**
     * Final message from the agent.
     */
    #[Optional]
    public ?string $message;

    /**
     * Steps taken by the agent.
     *
     * @var list<mixed>|null $steps
     */
    #[Optional(list: 'mixed')]
    public ?array $steps;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<mixed> $steps
     */
    public static function with(
        ?string $message = null,
        ?array $steps = null
    ): self {
        $self = new self;

        null !== $message && $self['message'] = $message;
        null !== $steps && $self['steps'] = $steps;

        return $self;
    }

    /**
     * Final message from the agent.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Steps taken by the agent.
     *
     * @param list<mixed> $steps
     */
    public function withSteps(array $steps): self
    {
        $self = clone $this;
        $self['steps'] = $steps;

        return $self;
    }
}
