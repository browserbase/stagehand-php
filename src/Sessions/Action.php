<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions;

use StagehandSDK\Core\Attributes\Optional;
use StagehandSDK\Core\Attributes\Required;
use StagehandSDK\Core\Concerns\SdkModel;
use StagehandSDK\Core\Contracts\BaseModel;

/**
 * Action object returned by observe and used by act.
 *
 * @phpstan-type ActionShape = array{
 *   description: string,
 *   selector: string,
 *   arguments?: list<string>|null,
 *   backendNodeID?: float|null,
 *   method?: string|null,
 * }
 */
final class Action implements BaseModel
{
    /** @use SdkModel<ActionShape> */
    use SdkModel;

    /**
     * Human-readable description of the action.
     */
    #[Required]
    public string $description;

    /**
     * CSS selector or XPath for the element.
     */
    #[Required]
    public string $selector;

    /**
     * Arguments to pass to the method.
     *
     * @var list<string>|null $arguments
     */
    #[Optional(list: 'string')]
    public ?array $arguments;

    /**
     * Backend node ID for the element.
     */
    #[Optional('backendNodeId')]
    public ?float $backendNodeID;

    /**
     * The method to execute (click, fill, etc.).
     */
    #[Optional]
    public ?string $method;

    /**
     * `new Action()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Action::with(description: ..., selector: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Action)->withDescription(...)->withSelector(...)
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
     * @param list<string>|null $arguments
     */
    public static function with(
        string $description,
        string $selector,
        ?array $arguments = null,
        ?float $backendNodeID = null,
        ?string $method = null,
    ): self {
        $self = new self;

        $self['description'] = $description;
        $self['selector'] = $selector;

        null !== $arguments && $self['arguments'] = $arguments;
        null !== $backendNodeID && $self['backendNodeID'] = $backendNodeID;
        null !== $method && $self['method'] = $method;

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
     * CSS selector or XPath for the element.
     */
    public function withSelector(string $selector): self
    {
        $self = clone $this;
        $self['selector'] = $selector;

        return $self;
    }

    /**
     * Arguments to pass to the method.
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
     * Backend node ID for the element.
     */
    public function withBackendNodeID(float $backendNodeID): self
    {
        $self = clone $this;
        $self['backendNodeID'] = $backendNodeID;

        return $self;
    }

    /**
     * The method to execute (click, fill, etc.).
     */
    public function withMethod(string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }
}
