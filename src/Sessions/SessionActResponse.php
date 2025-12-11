<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type SessionActResponseShape = array{
 *   actions: list<Action>, message: string, success: bool
 * }
 */
final class SessionActResponse implements BaseModel
{
    /** @use SdkModel<SessionActResponseShape> */
    use SdkModel;

    /**
     * Actions that were executed.
     *
     * @var list<Action> $actions
     */
    #[Required(list: Action::class)]
    public array $actions;

    /**
     * Result message.
     */
    #[Required]
    public string $message;

    /**
     * Whether the action succeeded.
     */
    #[Required]
    public bool $success;

    /**
     * `new SessionActResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SessionActResponse::with(actions: ..., message: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SessionActResponse)->withActions(...)->withMessage(...)->withSuccess(...)
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
     * @param list<Action|array{
     *   arguments: list<string>,
     *   description: string,
     *   method: string,
     *   selector: string,
     *   backendNodeID?: int|null,
     * }> $actions
     */
    public static function with(
        array $actions,
        string $message,
        bool $success
    ): self {
        $self = new self;

        $self['actions'] = $actions;
        $self['message'] = $message;
        $self['success'] = $success;

        return $self;
    }

    /**
     * Actions that were executed.
     *
     * @param list<Action|array{
     *   arguments: list<string>,
     *   description: string,
     *   method: string,
     *   selector: string,
     *   backendNodeID?: int|null,
     * }> $actions
     */
    public function withActions(array $actions): self
    {
        $self = clone $this;
        $self['actions'] = $actions;

        return $self;
    }

    /**
     * Result message.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Whether the action succeeded.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
