<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint;

enum Device: string
{
    case DESKTOP = 'desktop';

    case MOBILE = 'mobile';
}
