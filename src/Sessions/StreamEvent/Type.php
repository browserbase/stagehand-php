<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\StreamEvent;

/**
 * Type of stream event - system events or log messages.
 */
enum Type: string
{
    case SYSTEM = 'system';

    case LOG = 'log';
}
