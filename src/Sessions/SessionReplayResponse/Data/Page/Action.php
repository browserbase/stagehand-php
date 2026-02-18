<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionReplayResponse\Data\Page;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionReplayResponse\Data\Page\Action\TokenUsage;

/**
 * @phpstan-import-type TokenUsageShape from \Stagehand\Sessions\SessionReplayResponse\Data\Page\Action\TokenUsage
 *
 * @phpstan-type ActionShape = array{
 *   method: string,
 *   parameters: array<string,mixed>,
 *   result: array<string,mixed>,
 *   timestamp: float,
 *   endTime?: float|null,
 *   tokenUsage?: null|TokenUsage|TokenUsageShape,
 * }
 */
final class Action implements BaseModel
{
    /** @use SdkModel<ActionShape> */
    use SdkModel;

    #[Required]
    public string $method;

    /** @var array<string,mixed> $parameters */
    #[Required(map: 'mixed')]
    public array $parameters;

    /** @var array<string,mixed> $result */
    #[Required(map: 'mixed')]
    public array $result;

    #[Required]
    public float $timestamp;

    #[Optional]
    public ?float $endTime;

    #[Optional]
    public ?TokenUsage $tokenUsage;

    /**
     * `new Action()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Action::with(method: ..., parameters: ..., result: ..., timestamp: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Action)
     *   ->withMethod(...)
     *   ->withParameters(...)
     *   ->withResult(...)
     *   ->withTimestamp(...)
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
     * @param array<string,mixed> $parameters
     * @param array<string,mixed> $result
     * @param TokenUsage|TokenUsageShape|null $tokenUsage
     */
    public static function with(
        string $method,
        array $parameters,
        array $result,
        float $timestamp,
        ?float $endTime = null,
        TokenUsage|array|null $tokenUsage = null,
    ): self {
        $self = new self;

        $self['method'] = $method;
        $self['parameters'] = $parameters;
        $self['result'] = $result;
        $self['timestamp'] = $timestamp;

        null !== $endTime && $self['endTime'] = $endTime;
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
     * @param array<string,mixed> $parameters
     */
    public function withParameters(array $parameters): self
    {
        $self = clone $this;
        $self['parameters'] = $parameters;

        return $self;
    }

    /**
     * @param array<string,mixed> $result
     */
    public function withResult(array $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }

    public function withTimestamp(float $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    public function withEndTime(float $endTime): self
    {
        $self = clone $this;
        $self['endTime'] = $endTime;

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
