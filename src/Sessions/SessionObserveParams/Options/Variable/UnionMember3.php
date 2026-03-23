<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionObserveParams\Options\Variable;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ValueVariants from \Stagehand\Sessions\SessionObserveParams\Options\Variable\UnionMember3\Value
 * @phpstan-import-type ValueShape from \Stagehand\Sessions\SessionObserveParams\Options\Variable\UnionMember3\Value
 *
 * @phpstan-type UnionMember3Shape = array{
 *   value: ValueShape, description?: string|null
 * }
 */
final class UnionMember3 implements BaseModel
{
    /** @use SdkModel<UnionMember3Shape> */
    use SdkModel;

    /** @var ValueVariants $value */
    #[Required]
    public string|float|bool $value;

    #[Optional]
    public ?string $description;

    /**
     * `new UnionMember3()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember3::with(value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember3)->withValue(...)
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
     * @param ValueShape $value
     */
    public static function with(
        string|float|bool $value,
        ?string $description = null
    ): self {
        $self = new self;

        $self['value'] = $value;

        null !== $description && $self['description'] = $description;

        return $self;
    }

    /**
     * @param ValueShape $value
     */
    public function withValue(string|float|bool $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
