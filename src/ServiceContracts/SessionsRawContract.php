<?php

declare(strict_types=1);

namespace Stagehand\ServiceContracts;

use Stagehand\Core\Contracts\BaseResponse;
use Stagehand\Core\Exceptions\APIException;
use Stagehand\RequestOptions;
use Stagehand\Sessions\SessionStartParams;

interface SessionsRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|SessionStartParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function start(
        array|SessionStartParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
