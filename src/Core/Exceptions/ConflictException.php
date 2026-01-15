<?php

namespace StagehandSDK\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'StagehandSDK Conflict Exception';
}
