<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteResponse;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionExecuteResponse\Data\CacheEntry;
use Stagehand\Sessions\SessionExecuteResponse\Data\Result;

/**
 * @phpstan-import-type ResultShape from \Stagehand\Sessions\SessionExecuteResponse\Data\Result
 * @phpstan-import-type CacheEntryShape from \Stagehand\Sessions\SessionExecuteResponse\Data\CacheEntry
 *
 * @phpstan-type DataShape = array{
 *   result: Result|ResultShape, cacheEntry?: null|CacheEntry|CacheEntryShape
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    #[Required]
    public Result $result;

    #[Optional]
    public ?CacheEntry $cacheEntry;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(result: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withResult(...)
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
     * @param Result|ResultShape $result
     * @param CacheEntry|CacheEntryShape|null $cacheEntry
     */
    public static function with(
        Result|array $result,
        CacheEntry|array|null $cacheEntry = null
    ): self {
        $self = new self;

        $self['result'] = $result;

        null !== $cacheEntry && $self['cacheEntry'] = $cacheEntry;

        return $self;
    }

    /**
     * @param Result|ResultShape $result
     */
    public function withResult(Result|array $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }

    /**
     * @param CacheEntry|CacheEntryShape $cacheEntry
     */
    public function withCacheEntry(CacheEntry|array $cacheEntry): self
    {
        $self = clone $this;
        $self['cacheEntry'] = $cacheEntry;

        return $self;
    }
}
