<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExtractParams;

/**
 * Client SDK language.
 */
enum XLanguage: string
{
    case TYPESCRIPT = 'typescript';

    case PYTHON = 'python';

    case PLAYGROUND = 'playground';
}
