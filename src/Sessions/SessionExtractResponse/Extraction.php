<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExtractResponse;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * Default extraction result.
 *
 * @phpstan-type ExtractionShape = array{extraction?: string|null}
 */
final class Extraction implements BaseModel
{
    /** @use SdkModel<ExtractionShape> */
    use SdkModel;

    #[Optional]
    public ?string $extraction;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $extraction = null): self
    {
        $self = new self;

        null !== $extraction && $self['extraction'] = $extraction;

        return $self;
    }

    public function withExtraction(string $extraction): self
    {
        $self = clone $this;
        $self['extraction'] = $extraction;

        return $self;
    }
}
