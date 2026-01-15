<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\StreamEvent\Data\StreamEventSystemDataOutput;

/**
 * Current status of the streaming operation.
 */
enum Status: string
{
    case STARTING = 'starting';

    case CONNECTED = 'connected';

    case RUNNING = 'running';

    case FINISHED = 'finished';

    case ERROR = 'error';
}
