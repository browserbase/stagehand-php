<?php

declare(strict_types=1);

namespace Stagehand\Sessions\ModelConfig\ModelConfigObject;

/**
 * AI provider for the model (or provide a baseURL endpoint instead).
 */
enum Provider: string
{
    case OPENAI = 'openai';

    case ANTHROPIC = 'anthropic';

    case GOOGLE = 'google';

    case MICROSOFT = 'microsoft';
}
