<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteParams\AgentConfig;

/**
 * Tool mode for the agent (dom, hybrid, cua). If set, overrides cua.
 */
enum Mode: string
{
    case DOM = 'dom';

    case HYBRID = 'hybrid';

    case CUA = 'cua';
}
