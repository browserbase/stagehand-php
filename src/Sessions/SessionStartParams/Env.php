<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams;

/**
 * Environment to run the browser in.
 */
enum Env: string
{
    case LOCAL = 'LOCAL';

    case BROWSERBASE = 'BROWSERBASE';
}
