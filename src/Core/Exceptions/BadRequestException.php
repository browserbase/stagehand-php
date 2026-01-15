<?php

namespace StagehandSDK\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'StagehandSDK Bad Request Exception';
}
