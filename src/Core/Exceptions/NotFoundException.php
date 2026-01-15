<?php

namespace StagehandSDK\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'StagehandSDK Not Found Exception';
}
