<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\SessionActParams;

/**
 * Whether to stream the response via SSE.
 */
enum XStreamResponse: string
{
    case TRUE = 'true';

    case FALSE = 'false';
}
