<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionObserveParams;

enum XStreamResponse: string
{
    case TRUE = 'true';

    case FALSE = 'false';
}
