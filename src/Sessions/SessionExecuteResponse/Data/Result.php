<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteResponse\Data;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionExecuteResponse\Data\Result\Action;
use Stagehand\Sessions\SessionExecuteResponse\Data\Result\Usage;

/**
 * @phpstan-import-type ActionShape from \Stagehand\Sessions\SessionExecuteResponse\Data\Result\Action
 * @phpstan-import-type UsageShape from \Stagehand\Sessions\SessionExecuteResponse\Data\Result\Usage
 *
 * @phpstan-type ResultShape = array{
 *   actions: list<ActionShape>,
 *   completed: bool,
 *   message: string,
 *   success: bool,
 *   metadata?: array<string,mixed>|null,
 *   usage?: null|Usage|UsageShape,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /** @var list<Action> $actions */
    #[Required(list: Action::class)]
    public array $actions;

    /**
     * Whether the agent finished its task.
     */
    #[Required]
    public bool $completed;

    /**
     * Summary of what the agent accomplished.
     */
    #[Required]
    public string $message;

    /**
     * Whether the agent completed successfully.
     */
    #[Required]
    public bool $success;

    /** @var array<string,mixed>|null $metadata */
    #[Optional(map: 'mixed')]
    public ?array $metadata;

    #[Optional]
    public ?Usage $usage;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(actions: ..., completed: ..., message: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)
     *   ->withActions(...)
     *   ->withCompleted(...)
     *   ->withMessage(...)
     *   ->withSuccess(...)
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
     * @param list<ActionShape> $actions
     * @param array<string,mixed> $metadata
     * @param UsageShape $usage
     */
    public static function with(
        array $actions,
        bool $completed,
        string $message,
        bool $success,
        ?array $metadata = null,
        Usage|array|null $usage = null,
    ): self {
        $self = new self;

        $self['actions'] = $actions;
        $self['completed'] = $completed;
        $self['message'] = $message;
        $self['success'] = $success;

        null !== $metadata && $self['metadata'] = $metadata;
        null !== $usage && $self['usage'] = $usage;

        return $self;
    }

    /**
     * @param list<ActionShape> $actions
     */
    public function withActions(array $actions): self
    {
        $self = clone $this;
        $self['actions'] = $actions;

        return $self;
    }

    /**
     * Whether the agent finished its task.
     */
    public function withCompleted(bool $completed): self
    {
        $self = clone $this;
        $self['completed'] = $completed;

        return $self;
    }

    /**
     * Summary of what the agent accomplished.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Whether the agent completed successfully.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * @param array<string,mixed> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * @param UsageShape $usage
     */
    public function withUsage(Usage|array $usage): self
    {
        $self = clone $this;
        $self['usage'] = $usage;

        return $self;
    }
}
