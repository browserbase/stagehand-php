<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteAgentParams;

enum XStreamResponse: string
{
    case TRUE = 'true';

    case FALSE = 'false';
}
