<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\SessionExecuteParams\AgentConfig;

/**
 * AI provider for the agent (legacy, use model: openai/gpt-5-nano instead).
 */
enum Provider: string
{
    case OPENAI = 'openai';

    case ANTHROPIC = 'anthropic';

    case GOOGLE = 'google';

    case MICROSOFT = 'microsoft';
}
