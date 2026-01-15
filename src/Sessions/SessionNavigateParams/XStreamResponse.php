<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionNavigateParams;

/**
 * Whether to stream the response via SSE.
 */
enum XStreamResponse: string
{
    case TRUE = 'true';

    case FALSE = 'false';
}
