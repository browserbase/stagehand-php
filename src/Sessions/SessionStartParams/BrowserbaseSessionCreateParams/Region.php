<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionStartParams\BrowserbaseSessionCreateParams;

enum Region: string
{
    case US_WEST_2 = 'us-west-2';

    case US_EAST_1 = 'us-east-1';

    case EU_CENTRAL_1 = 'eu-central-1';

    case AP_SOUTHEAST_1 = 'ap-southeast-1';
}
