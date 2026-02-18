<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionReplayResponse;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionReplayResponse\Data\Page;

/**
 * @phpstan-import-type PageShape from \Stagehand\Sessions\SessionReplayResponse\Data\Page
 *
 * @phpstan-type DataShape = array{
 *   pages: list<Page|PageShape>, clientLanguage?: string|null
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /** @var list<Page> $pages */
    #[Required(list: Page::class)]
    public array $pages;

    #[Optional]
    public ?string $clientLanguage;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(pages: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withPages(...)
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
     * @param list<Page|PageShape> $pages
     */
    public static function with(
        array $pages,
        ?string $clientLanguage = null
    ): self {
        $self = new self;

        $self['pages'] = $pages;

        null !== $clientLanguage && $self['clientLanguage'] = $clientLanguage;

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

    public function withClientLanguage(string $clientLanguage): self
    {
        $self = clone $this;
        $self['clientLanguage'] = $clientLanguage;

        return $self;
    }
}
