<?php

namespace StagehandSDK\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'StagehandSDK Internal Server Exception';
}
