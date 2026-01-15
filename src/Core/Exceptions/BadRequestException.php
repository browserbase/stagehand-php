<?php

namespace Stagehand\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Stagehand Bad Request Exception';
}
