<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionReplayResponse\Data;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionReplayResponse\Data\Page\Action;

/**
 * @phpstan-import-type ActionShape from \Stagehand\Sessions\SessionReplayResponse\Data\Page\Action
 *
 * @phpstan-type PageShape = array{actions?: list<Action|ActionShape>|null}
 */
final class Page implements BaseModel
{
    /** @use SdkModel<PageShape> */
    use SdkModel;

    /** @var list<Action>|null $actions */
    #[Optional(list: Action::class)]
    public ?array $actions;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Action|ActionShape>|null $actions
     */
    public static function with(?array $actions = null): self
    {
        $self = new self;

        null !== $actions && $self['actions'] = $actions;

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
}
