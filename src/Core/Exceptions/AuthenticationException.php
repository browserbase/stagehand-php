<?php

namespace Stagehand\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Stagehand Authentication Exception';
}
