<?php

declare(strict_types=1);

namespace Stagehand\Sessions\ModelConfig;

enum Provider: string
{
    case OPENAI = 'openai';

    case ANTHROPIC = 'anthropic';

    case GOOGLE = 'google';
}
