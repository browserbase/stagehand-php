<?php

namespace StagehandSDK\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'StagehandSDK Permission Denied Exception';
}
