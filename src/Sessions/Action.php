<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type ActionShape = array{
 *   arguments: list<string>,
 *   description: string,
 *   method: string,
 *   selector: string,
 *   backendNodeID?: int|null,
 * }
 */
final class Action implements BaseModel
{
    /** @use SdkModel<ActionShape> */
    use SdkModel;

    /**
     * Arguments for the method.
     *
     * @var list<string> $arguments
     */
    #[Required(list: 'string')]
    public array $arguments;

    /**
     * Human-readable description of the action.
     */
    #[Required]
    public string $description;

    /**
     * Method to execute (e.g., "click", "fill").
     */
    #[Required]
    public string $method;

    /**
     * CSS or XPath selector for the element.
     */
    #[Required]
    public string $selector;

    /**
     * CDP backend node ID.
     */
    #[Optional('backendNodeId')]
    public ?int $backendNodeID;

    /**
     * `new Action()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Action::with(arguments: ..., description: ..., method: ..., selector: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Action)
     *   ->withArguments(...)
     *   ->withDescription(...)
     *   ->withMethod(...)
     *   ->withSelector(...)
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
     * @param list<string> $arguments
     */
    public static function with(
        array $arguments,
        string $description,
        string $method,
        string $selector,
        ?int $backendNodeID = null,
    ): self {
        $self = new self;

        $self['arguments'] = $arguments;
        $self['description'] = $description;
        $self['method'] = $method;
        $self['selector'] = $selector;

        null !== $backendNodeID && $self['backendNodeID'] = $backendNodeID;

        return $self;
    }

    /**
     * Arguments for the method.
     *
     * @param list<string> $arguments
     */
    public function withArguments(array $arguments): self
    {
        $self = clone $this;
        $self['arguments'] = $arguments;

        return $self;
    }

    /**
     * Human-readable description of the action.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Method to execute (e.g., "click", "fill").
     */
    public function withMethod(string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }

    /**
     * CSS or XPath selector for the element.
     */
    public function withSelector(string $selector): self
    {
        $self = clone $this;
        $self['selector'] = $selector;

        return $self;
    }

    /**
     * CDP backend node ID.
     */
    public function withBackendNodeID(int $backendNodeID): self
    {
        $self = clone $this;
        $self['backendNodeID'] = $backendNodeID;

        return $self;
    }
}
