<?php

namespace Stagehand\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Stagehand Conflict Exception';
}
