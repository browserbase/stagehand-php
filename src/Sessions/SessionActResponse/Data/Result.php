<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\SessionActResponse\Data;

use StagehandSDK\Core\Attributes\Required;
use StagehandSDK\Core\Concerns\SdkModel;
use StagehandSDK\Core\Contracts\BaseModel;
use StagehandSDK\Sessions\SessionActResponse\Data\Result\Action;

/**
 * @phpstan-import-type ActionShape from \StagehandSDK\Sessions\SessionActResponse\Data\Result\Action
 *
 * @phpstan-type ResultShape = array{
 *   actionDescription: string,
 *   actions: list<Action|ActionShape>,
 *   message: string,
 *   success: bool,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * Description of the action that was performed.
     */
    #[Required]
    public string $actionDescription;

    /**
     * List of actions that were executed.
     *
     * @var list<Action> $actions
     */
    #[Required(list: Action::class)]
    public array $actions;

    /**
     * Human-readable result message.
     */
    #[Required]
    public string $message;

    /**
     * Whether the action completed successfully.
     */
    #[Required]
    public bool $success;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(actionDescription: ..., actions: ..., message: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)
     *   ->withActionDescription(...)
     *   ->withActions(...)
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
     * @param list<Action|ActionShape> $actions
     */
    public static function with(
        string $actionDescription,
        array $actions,
        string $message,
        bool $success
    ): self {
        $self = new self;

        $self['actionDescription'] = $actionDescription;
        $self['actions'] = $actions;
        $self['message'] = $message;
        $self['success'] = $success;

        return $self;
    }

    /**
     * Description of the action that was performed.
     */
    public function withActionDescription(string $actionDescription): self
    {
        $self = clone $this;
        $self['actionDescription'] = $actionDescription;

        return $self;
    }

    /**
     * List of actions that were executed.
     *
     * @param list<Action|ActionShape> $actions
     */
    public function withActions(array $actions): self
    {
        $self = clone $this;
        $self['actions'] = $actions;

        return $self;
    }

    /**
     * Human-readable result message.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Whether the action completed successfully.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
