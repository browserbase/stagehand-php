<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings;

enum Os: string
{
    case WINDOWS = 'windows';

    case MAC = 'mac';

    case LINUX = 'linux';

    case MOBILE = 'mobile';

    case TABLET = 'tablet';
}
