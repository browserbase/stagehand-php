<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * @phpstan-type SessionEndResponseShape = array{success: bool}
 */
final class SessionEndResponse implements BaseModel
{
    /** @use SdkModel<SessionEndResponseShape> */
    use SdkModel;

    #[Required]
    public bool $success = true;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }
}
