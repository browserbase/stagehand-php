<?php

declare(strict_types=1);

namespace Stagehand\ServiceContracts;

use Stagehand\Core\Contracts\BaseResponse;
use Stagehand\Core\Exceptions\APIException;
use Stagehand\RequestOptions;
use Stagehand\Sessions\Action;
use Stagehand\Sessions\SessionActParams;
use Stagehand\Sessions\SessionActResponse;
use Stagehand\Sessions\SessionEndResponse;
use Stagehand\Sessions\SessionExecuteAgentParams;
use Stagehand\Sessions\SessionExecuteAgentResponse;
use Stagehand\Sessions\SessionExtractParams;
use Stagehand\Sessions\SessionExtractResponse\Extraction;
use Stagehand\Sessions\SessionNavigateParams;
use Stagehand\Sessions\SessionNavigateResponse;
use Stagehand\Sessions\SessionObserveParams;
use Stagehand\Sessions\SessionStartParams;
use Stagehand\Sessions\SessionStartResponse;

interface SessionsRawContract
{
    /**
     * @api
     *
     * @param string $sessionID Path param: The session ID returned by /sessions/start
     * @param array<mixed>|SessionActParams $params
     *
     * @return BaseResponse<SessionActResponse>
     *
     * @throws APIException
     */
    public function act(
        string $sessionID,
        array|SessionActParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $sessionID The session ID returned by /sessions/start
     *
     * @return BaseResponse<SessionEndResponse>
     *
     * @throws APIException
     */
    public function end(
        string $sessionID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $sessionID Path param: The session ID returned by /sessions/start
     * @param array<mixed>|SessionExecuteAgentParams $params
     *
     * @return BaseResponse<SessionExecuteAgentResponse>
     *
     * @throws APIException
     */
    public function executeAgent(
        string $sessionID,
        array|SessionExecuteAgentParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $sessionID Path param: The session ID returned by /sessions/start
     * @param array<mixed>|SessionExtractParams $params
     *
     * @return BaseResponse<Extraction|array<string,mixed>>
     *
     * @throws APIException
     */
    public function extract(
        string $sessionID,
        array|SessionExtractParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $sessionID Path param: The session ID returned by /sessions/start
     * @param array<mixed>|SessionNavigateParams $params
     *
     * @return BaseResponse<SessionNavigateResponse>
     *
     * @throws APIException
     */
    public function navigate(
        string $sessionID,
        array|SessionNavigateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $sessionID Path param: The session ID returned by /sessions/start
     * @param array<mixed>|SessionObserveParams $params
     *
     * @return BaseResponse<list<Action>>
     *
     * @throws APIException
     */
    public function observe(
        string $sessionID,
        array|SessionObserveParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|SessionStartParams $params
     *
     * @return BaseResponse<SessionStartResponse>
     *
     * @throws APIException
     */
    public function start(
        array|SessionStartParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
