<?php

namespace Stagehand\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Stagehand Not Found Exception';
}
