<?php

declare(strict_types=1);

namespace Stagehand\ServiceContracts;

use Stagehand\Core\Contracts\BaseResponse;
use Stagehand\Core\Exceptions\APIException;
use Stagehand\RequestOptions;
use Stagehand\Sessions\SessionActParams;
use Stagehand\Sessions\SessionEndParams;
use Stagehand\Sessions\SessionExecuteAgentParams;
use Stagehand\Sessions\SessionExtractParams;
use Stagehand\Sessions\SessionNavigateParams;
use Stagehand\Sessions\SessionObserveParams;
use Stagehand\Sessions\SessionStartParams;

interface SessionsRawContract
{
    /**
     * @api
     *
     * @param mixed $id Path param: Unique session identifier
     * @param array<string,mixed>|SessionActParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function act(
        mixed $id,
        array|SessionActParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param mixed $id Unique session identifier
     * @param array<string,mixed>|SessionEndParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function end(
        mixed $id,
        array|SessionEndParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param mixed $id Path param: Unique session identifier
     * @param array<string,mixed>|SessionExecuteAgentParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function executeAgent(
        mixed $id,
        array|SessionExecuteAgentParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param mixed $id Path param: Unique session identifier
     * @param array<string,mixed>|SessionExtractParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function extract(
        mixed $id,
        array|SessionExtractParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param mixed $id Path param: Unique session identifier
     * @param array<string,mixed>|SessionNavigateParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function navigate(
        mixed $id,
        array|SessionNavigateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param mixed $id Path param: Unique session identifier
     * @param array<string,mixed>|SessionObserveParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function observe(
        mixed $id,
        array|SessionObserveParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SessionStartParams $params
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
