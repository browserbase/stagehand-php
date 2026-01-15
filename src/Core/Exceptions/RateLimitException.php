<?php

namespace Stagehand\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Stagehand Rate Limit Exception';
}
