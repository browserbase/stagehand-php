<?php

namespace Stagehand\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Stagehand Unprocessable Entity Exception';
}
