<?php

namespace StagehandSDK\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'StagehandSDK Authentication Exception';
}
