<?php

namespace Stagehand\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Stagehand Permission Denied Exception';
}
