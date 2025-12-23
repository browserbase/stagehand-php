<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint;

enum OperatingSystem: string
{
    case ANDROID = 'android';

    case IOS = 'ios';

    case LINUX = 'linux';

    case MACOS = 'macos';

    case WINDOWS = 'windows';
}
