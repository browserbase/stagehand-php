<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionReplayResponse;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionReplayResponse\Data\Page;

/**
 * @phpstan-import-type PageShape from \Stagehand\Sessions\SessionReplayResponse\Data\Page
 *
 * @phpstan-type DataShape = array{pages?: list<Page|PageShape>|null}
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /** @var list<Page>|null $pages */
    #[Optional(list: Page::class)]
    public ?array $pages;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Page|PageShape>|null $pages
     */
    public static function with(?array $pages = null): self
    {
        $self = new self;

        null !== $pages && $self['pages'] = $pages;

        return $self;
    }

    /**
     * @param list<Page|PageShape> $pages
     */
    public function withPages(array $pages): self
    {
        $self = clone $this;
        $self['pages'] = $pages;

        return $self;
    }
}
