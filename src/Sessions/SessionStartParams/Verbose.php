<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams;

/**
 * Logging verbosity level (0=quiet, 1=normal, 2=debug).
 */
enum Verbose: string
{
    case _0 = '0';

    case _1 = '1';

    case _2 = '2';
}
