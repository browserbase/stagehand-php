<?php

declare(strict_types=1);

namespace StagehandSDK\ServiceContracts;

use StagehandSDK\Core\Contracts\BaseResponse;
use StagehandSDK\Core\Contracts\BaseStream;
use StagehandSDK\Core\Exceptions\APIException;
use StagehandSDK\RequestOptions;
use StagehandSDK\Sessions\SessionActParams;
use StagehandSDK\Sessions\SessionActResponse;
use StagehandSDK\Sessions\SessionEndParams;
use StagehandSDK\Sessions\SessionEndResponse;
use StagehandSDK\Sessions\SessionExecuteParams;
use StagehandSDK\Sessions\SessionExecuteResponse;
use StagehandSDK\Sessions\SessionExtractParams;
use StagehandSDK\Sessions\SessionExtractResponse;
use StagehandSDK\Sessions\SessionNavigateParams;
use StagehandSDK\Sessions\SessionNavigateResponse;
use StagehandSDK\Sessions\SessionObserveParams;
use StagehandSDK\Sessions\SessionObserveResponse;
use StagehandSDK\Sessions\SessionStartParams;
use StagehandSDK\Sessions\SessionStartResponse;
use StagehandSDK\Sessions\StreamEvent;

/**
 * @phpstan-import-type RequestOpts from \StagehandSDK\RequestOptions
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
     * @param string $id Path param: Unique session identifier
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
