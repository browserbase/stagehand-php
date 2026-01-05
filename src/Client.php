<?php

declare(strict_types=1);

namespace Stagehand;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Stagehand\Core\BaseClient;
use Stagehand\Core\Util;
use Stagehand\Services\SessionsService;

class Client extends BaseClient
{
    public string $browserbaseAPIKey;

    public string $browserbaseProjectID;

    public string $modelAPIKey;

    /**
     * @api
     */
    public SessionsService $sessions;

    public function __construct(
        ?string $browserbaseAPIKey = null,
        ?string $browserbaseProjectID = null,
        ?string $modelAPIKey = null,
        ?string $baseUrl = null,
    ) {
        $this->browserbaseAPIKey = (string) ($browserbaseAPIKey ?? getenv('BROWSERBASE_API_KEY'));
        $this->browserbaseProjectID = (string) ($browserbaseProjectID ?? getenv('BROWSERBASE_PROJECT_ID'));
        $this->modelAPIKey = (string) ($modelAPIKey ?? getenv('MODEL_API_KEY'));

        $baseUrl ??= getenv(
            'STAGEHAND_BASE_URL'
        ) ?: 'https://api.stagehand.browserbase.com';

        $options = RequestOptions::with(
            uriFactory: Psr17FactoryDiscovery::findUriFactory(),
            streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
            requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
            transporter: Psr18ClientDiscovery::find(),
        );

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => sprintf('stagehand/PHP %s', VERSION),
                'X-Stainless-Lang' => 'php',
                'X-Stainless-Package-Version' => '0.2.0',
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
}
