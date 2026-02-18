<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionReplayResponse\Data;

use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionReplayResponse\Data\Page\Action;

/**
 * @phpstan-import-type ActionShape from \Stagehand\Sessions\SessionReplayResponse\Data\Page\Action
 *
 * @phpstan-type PageShape = array{
 *   actions: list<Action|ActionShape>,
 *   duration: float,
 *   timestamp: float,
 *   url: string,
 * }
 */
final class Page implements BaseModel
{
    /** @use SdkModel<PageShape> */
    use SdkModel;

    /** @var list<Action> $actions */
    #[Required(list: Action::class)]
    public array $actions;

    #[Required]
    public float $duration;

    #[Required]
    public float $timestamp;

    #[Required]
    public string $url;

    /**
     * `new Page()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Page::with(actions: ..., duration: ..., timestamp: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Page)
     *   ->withActions(...)
     *   ->withDuration(...)
     *   ->withTimestamp(...)
     *   ->withURL(...)
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
        array $actions,
        float $duration,
        float $timestamp,
        string $url
    ): self {
        $self = new self;

        $self['actions'] = $actions;
        $self['duration'] = $duration;
        $self['timestamp'] = $timestamp;
        $self['url'] = $url;

        return $self;
    }

    /**
     * @param list<Action|ActionShape> $actions
     */
    public function withActions(array $actions): self
    {
        $self = clone $this;
        $self['actions'] = $actions;

        return $self;
    }

    public function withDuration(float $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    public function withTimestamp(float $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
