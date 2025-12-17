<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionNavigateParams\Options;

/**
 * When to consider navigation complete.
 */
enum WaitUntil: string
{
    case LOAD = 'load';

    case DOMCONTENTLOADED = 'domcontentloaded';

    case NETWORKIDLE = 'networkidle';
}
