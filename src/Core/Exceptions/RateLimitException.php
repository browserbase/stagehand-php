<?php

namespace StagehandSDK\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'StagehandSDK Rate Limit Exception';
}
