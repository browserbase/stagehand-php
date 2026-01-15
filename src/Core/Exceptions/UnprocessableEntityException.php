<?php

namespace StagehandSDK\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'StagehandSDK Unprocessable Entity Exception';
}
