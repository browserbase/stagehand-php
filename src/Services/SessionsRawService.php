<?php

declare(strict_types=1);

namespace Stagehand\Services;

use Stagehand\Client;
use Stagehand\Core\Contracts\BaseResponse;
use Stagehand\Core\Exceptions\APIException;
use Stagehand\Core\Util;
use Stagehand\RequestOptions;
use Stagehand\ServiceContracts\SessionsRawContract;
use Stagehand\Sessions\SessionStartParams;

final class SessionsRawService implements SessionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a new browser session with the specified configuration. Returns a session ID used for all subsequent operations.
     *
     * @param array{
     *   body?: mixed,
     *   xLanguage?: mixed,
     *   xSDKVersion?: mixed,
     *   xSentAt?: mixed,
     *   xStreamResponse?: mixed,
     * }|SessionStartParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function start(
        array|SessionStartParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = SessionStartParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'sessions/start',
            headers: Util::array_transform_keys(
                array_diff_key($parsed, array_flip(['body'])),
                [
                    'xLanguage' => 'x-language',
                    'xSDKVersion' => 'x-sdk-version',
                    'xSentAt' => 'x-sent-at',
                    'xStreamResponse' => 'x-stream-response',
                ],
            ),
            body: $parsed['body'],
            options: $options,
            convert: 'mixed',
        );
    }
}
