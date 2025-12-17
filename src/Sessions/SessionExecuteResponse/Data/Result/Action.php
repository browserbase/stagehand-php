<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteResponse\Data\Result;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type ActionShape = array{
 *   type: string,
 *   action?: string|null,
 *   instruction?: string|null,
 *   pageText?: string|null,
 *   pageURL?: string|null,
 *   reasoning?: string|null,
 *   taskCompleted?: bool|null,
 *   timeMs?: float|null,
 * }
 */
final class Action implements BaseModel
{
    /** @use SdkModel<ActionShape> */
    use SdkModel;

    /**
     * Type of action taken.
     */
    #[Required]
    public string $type;

    #[Optional]
    public ?string $action;

    #[Optional]
    public ?string $instruction;

    #[Optional]
    public ?string $pageText;

    #[Optional('pageUrl')]
    public ?string $pageURL;

    /**
     * Agent's reasoning for taking this action.
     */
    #[Optional]
    public ?string $reasoning;

    #[Optional]
    public ?bool $taskCompleted;

    /**
     * Time taken for this action in ms.
     */
    #[Optional]
    public ?float $timeMs;

    /**
     * `new Action()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Action::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Action)->withType(...)
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
        string $type,
        ?string $action = null,
        ?string $instruction = null,
        ?string $pageText = null,
        ?string $pageURL = null,
        ?string $reasoning = null,
        ?bool $taskCompleted = null,
        ?float $timeMs = null,
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $action && $self['action'] = $action;
        null !== $instruction && $self['instruction'] = $instruction;
        null !== $pageText && $self['pageText'] = $pageText;
        null !== $pageURL && $self['pageURL'] = $pageURL;
        null !== $reasoning && $self['reasoning'] = $reasoning;
        null !== $taskCompleted && $self['taskCompleted'] = $taskCompleted;
        null !== $timeMs && $self['timeMs'] = $timeMs;

        return $self;
    }

    /**
     * Type of action taken.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withAction(string $action): self
    {
        $self = clone $this;
        $self['action'] = $action;

        return $self;
    }

    public function withInstruction(string $instruction): self
    {
        $self = clone $this;
        $self['instruction'] = $instruction;

        return $self;
    }

    public function withPageText(string $pageText): self
    {
        $self = clone $this;
        $self['pageText'] = $pageText;

        return $self;
    }

    public function withPageURL(string $pageURL): self
    {
        $self = clone $this;
        $self['pageURL'] = $pageURL;

        return $self;
    }

    /**
     * Agent's reasoning for taking this action.
     */
    public function withReasoning(string $reasoning): self
    {
        $self = clone $this;
        $self['reasoning'] = $reasoning;

        return $self;
    }

    public function withTaskCompleted(bool $taskCompleted): self
    {
        $self = clone $this;
        $self['taskCompleted'] = $taskCompleted;

        return $self;
    }

    /**
     * Time taken for this action in ms.
     */
    public function withTimeMs(float $timeMs): self
    {
        $self = clone $this;
        $self['timeMs'] = $timeMs;

        return $self;
    }
}
