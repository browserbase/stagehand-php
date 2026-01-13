<?php

declare(strict_types=1);

namespace Stagehand;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Stagehand\Core\BaseClient;
use Stagehand\Core\Util;
use Stagehand\Services\SessionsService;

/**
 * @phpstan-import-type NormalizedRequest from \Stagehand\Core\BaseClient
 * @phpstan-import-type RequestOpts from \Stagehand\RequestOptions
 */
class Client extends BaseClient
{
    public string $browserbaseAPIKey;

    public string $browserbaseProjectID;

    public string $modelAPIKey;

    /**
     * @api
     */
    public SessionsService $sessions;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $browserbaseAPIKey = null,
        ?string $browserbaseProjectID = null,
        ?string $modelAPIKey = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->browserbaseAPIKey = (string) ($browserbaseAPIKey ?? getenv('BROWSERBASE_API_KEY'));
        $this->browserbaseProjectID = (string) ($browserbaseProjectID ?? getenv('BROWSERBASE_PROJECT_ID'));
        $this->modelAPIKey = (string) ($modelAPIKey ?? getenv('MODEL_API_KEY'));

        $baseUrl ??= getenv(
            'STAGEHAND_BASE_URL'
        ) ?: 'https://api.stagehand.browserbase.com';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => sprintf('stagehand/PHP %s', VERSION),
                'X-Stainless-Lang' => 'php',
                'X-Stainless-Package-Version' => '0.3.0',
                'X-Stainless-Arch' => Util::machtype(),
                'X-Stainless-OS' => Util::ostype(),
                'X-Stainless-Runtime' => php_sapi_name(),
                'X-Stainless-Runtime-Version' => phpversion(),
            ],
            baseUrl: $baseUrl,
            options: $options
        );

        $this->sessions = new SessionsService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return [
            ...$this->bbAPIKeyAuth(),
            ...$this->bbProjectIDAuth(),
            ...$this->llmModelAPIKeyAuth(),
        ];
    }

    /** @return array<string,string> */
    protected function bbAPIKeyAuth(): array
    {
        return $this->browserbaseAPIKey ? [
            'x-bb-api-key' => $this->browserbaseAPIKey,
        ] : [];
    }

    /** @return array<string,string> */
    protected function bbProjectIDAuth(): array
    {
        return $this->browserbaseProjectID ? [
            'x-bb-project-id' => $this->browserbaseProjectID,
        ] : [];
    }

    /** @return array<string,string> */
    protected function llmModelAPIKeyAuth(): array
    {
        return $this->modelAPIKey ? ['x-model-api-key' => $this->modelAPIKey] : [];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [...$this->authHeaders(), ...$headers],
            body: $body,
            opts: $opts,
        );
    }
}
