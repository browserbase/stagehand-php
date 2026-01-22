<?php

declare(strict_types=1);

namespace Stagehand\ServiceContracts;

use Stagehand\Core\Contracts\BaseResponse;
use Stagehand\Core\Contracts\BaseStream;
use Stagehand\Core\Exceptions\APIException;
use Stagehand\RequestOptions;
use Stagehand\Sessions\SessionActParams;
use Stagehand\Sessions\SessionActResponse;
use Stagehand\Sessions\SessionEndParams;
use Stagehand\Sessions\SessionEndResponse;
use Stagehand\Sessions\SessionExecuteParams;
use Stagehand\Sessions\SessionExecuteResponse;
use Stagehand\Sessions\SessionExtractParams;
use Stagehand\Sessions\SessionExtractResponse;
use Stagehand\Sessions\SessionNavigateParams;
use Stagehand\Sessions\SessionNavigateResponse;
use Stagehand\Sessions\SessionObserveParams;
use Stagehand\Sessions\SessionObserveResponse;
use Stagehand\Sessions\SessionReplayParams;
use Stagehand\Sessions\SessionReplayResponse;
use Stagehand\Sessions\SessionStartParams;
use Stagehand\Sessions\SessionStartResponse;
use Stagehand\Sessions\StreamEvent;

/**
 * @phpstan-import-type RequestOpts from \Stagehand\RequestOptions
 */
interface SessionsRawContract
{
    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param array<string,mixed>|SessionActParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionActResponse>
     *
     * @throws APIException
     */
    public function act(
        string $id,
        array|SessionActParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param array<string,mixed>|SessionActParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseStream<StreamEvent>>
     *
     * @throws APIException
     */
    public function actStream(
        string $id,
        array|SessionActParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Unique session identifier
     * @param array<string,mixed>|SessionEndParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionEndResponse>
     *
     * @throws APIException
     */
    public function end(
        string $id,
        array|SessionEndParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param array<string,mixed>|SessionExecuteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionExecuteResponse>
     *
     * @throws APIException
     */
    public function execute(
        string $id,
        array|SessionExecuteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param array<string,mixed>|SessionExecuteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseStream<StreamEvent>>
     *
     * @throws APIException
     */
    public function executeStream(
        string $id,
        array|SessionExecuteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param array<string,mixed>|SessionExtractParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionExtractResponse>
     *
     * @throws APIException
     */
    public function extract(
        string $id,
        array|SessionExtractParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param array<string,mixed>|SessionExtractParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseStream<StreamEvent>>
     *
     * @throws APIException
     */
    public function extractStream(
        string $id,
        array|SessionExtractParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param array<string,mixed>|SessionNavigateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionNavigateResponse>
     *
     * @throws APIException
     */
    public function navigate(
        string $id,
        array|SessionNavigateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param array<string,mixed>|SessionObserveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionObserveResponse>
     *
     * @throws APIException
     */
    public function observe(
        string $id,
        array|SessionObserveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Path param: Unique session identifier
     * @param array<string,mixed>|SessionObserveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseStream<StreamEvent>>
     *
     * @throws APIException
     */
    public function observeStream(
        string $id,
        array|SessionObserveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Unique session identifier
     * @param array<string,mixed>|SessionReplayParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionReplayResponse>
     *
     * @throws APIException
     */
    public function replay(
        string $id,
        array|SessionReplayParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|SessionStartParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SessionStartResponse>
     *
     * @throws APIException
     */
    public function start(
        array|SessionStartParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
