<?php

namespace Stagehand\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Stagehand Internal Server Exception';
}
