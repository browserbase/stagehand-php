<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint;

enum Browser: string
{
    case CHROME = 'chrome';

    case EDGE = 'edge';

    case FIREFOX = 'firefox';

    case SAFARI = 'safari';
}
