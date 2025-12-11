<?php

declare(strict_types=1);

namespace Stagehand\Core\Conversion\Contracts;

use Stagehand\Core\Conversion\CoerceState;
use Stagehand\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
