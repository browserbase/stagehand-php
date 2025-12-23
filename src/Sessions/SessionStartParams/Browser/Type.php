<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\Browser;

/**
 * Browser type to use.
 */
enum Type: string
{
    case LOCAL = 'local';

    case BROWSERBASE = 'browserbase';
}
