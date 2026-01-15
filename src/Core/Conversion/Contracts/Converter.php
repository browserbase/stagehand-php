<?php

declare(strict_types=1);

namespace StagehandSDK\Core\Conversion\Contracts;

use StagehandSDK\Core\Conversion\CoerceState;
use StagehandSDK\Core\Conversion\DumpState;

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
