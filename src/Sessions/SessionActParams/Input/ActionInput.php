<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionActParams\Input;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * Action object returned by observe and used by act.
 *
 * @phpstan-type ActionInputShape = array{
 *   description: string,
 *   selector: string,
 *   arguments?: list<string>|null,
 *   method?: string|null,
 * }
 */
final class ActionInput implements BaseModel
{
    /** @use SdkModel<ActionInputShape> */
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
     * The method to execute (click, fill, etc.).
     */
    #[Optional]
    public ?string $method;

    /**
     * `new ActionInput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ActionInput::with(description: ..., selector: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ActionInput)->withDescription(...)->withSelector(...)
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
        string $description,
        string $selector,
        ?array $arguments = null,
        ?string $method = null,
    ): self {
        $self = new self;

        $self['description'] = $description;
        $self['selector'] = $selector;

        null !== $arguments && $self['arguments'] = $arguments;
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
     * The method to execute (click, fill, etc.).
     */
    public function withMethod(string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }
}
