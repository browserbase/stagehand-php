<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteParams;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type ExecuteOptionsShape = array{
 *   instruction: string, highlightCursor?: bool|null, maxSteps?: float|null
 * }
 */
final class ExecuteOptions implements BaseModel
{
    /** @use SdkModel<ExecuteOptionsShape> */
    use SdkModel;

    /**
     * Natural language instruction for the agent.
     */
    #[Required]
    public string $instruction;

    /**
     * Whether to visually highlight the cursor during execution.
     */
    #[Optional]
    public ?bool $highlightCursor;

    /**
     * Maximum number of steps the agent can take.
     */
    #[Optional]
    public ?float $maxSteps;

    /**
     * `new ExecuteOptions()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ExecuteOptions::with(instruction: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ExecuteOptions)->withInstruction(...)
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
        string $instruction,
        ?bool $highlightCursor = null,
        ?float $maxSteps = null
    ): self {
        $self = new self;

        $self['instruction'] = $instruction;

        null !== $highlightCursor && $self['highlightCursor'] = $highlightCursor;
        null !== $maxSteps && $self['maxSteps'] = $maxSteps;

        return $self;
    }

    /**
     * Natural language instruction for the agent.
     */
    public function withInstruction(string $instruction): self
    {
        $self = clone $this;
        $self['instruction'] = $instruction;

        return $self;
    }

    /**
     * Whether to visually highlight the cursor during execution.
     */
    public function withHighlightCursor(bool $highlightCursor): self
    {
        $self = clone $this;
        $self['highlightCursor'] = $highlightCursor;

        return $self;
    }

    /**
     * Maximum number of steps the agent can take.
     */
    public function withMaxSteps(float $maxSteps): self
    {
        $self = clone $this;
        $self['maxSteps'] = $maxSteps;

        return $self;
    }
}
