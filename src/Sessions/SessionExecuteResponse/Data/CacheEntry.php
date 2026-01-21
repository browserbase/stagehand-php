<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteResponse\Data;

use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type CacheEntryShape = array{cacheKey: string, entry: mixed}
 */
final class CacheEntry implements BaseModel
{
    /** @use SdkModel<CacheEntryShape> */
    use SdkModel;

    /**
     * Opaque cache identifier computed from instruction, URL, options, and config.
     */
    #[Required]
    public string $cacheKey;

    /**
     * Serialized cache entry that can be written to disk.
     */
    #[Required]
    public mixed $entry;

    /**
     * `new CacheEntry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CacheEntry::with(cacheKey: ..., entry: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CacheEntry)->withCacheKey(...)->withEntry(...)
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
     */
    public static function with(string $cacheKey, mixed $entry): self
    {
        $self = new self;

        $self['cacheKey'] = $cacheKey;
        $self['entry'] = $entry;

        return $self;
    }

    /**
     * Opaque cache identifier computed from instruction, URL, options, and config.
     */
    public function withCacheKey(string $cacheKey): self
    {
        $self = clone $this;
        $self['cacheKey'] = $cacheKey;

        return $self;
    }

    /**
     * Serialized cache entry that can be written to disk.
     */
    public function withEntry(mixed $entry): self
    {
        $self = clone $this;
        $self['entry'] = $entry;

        return $self;
    }
}
