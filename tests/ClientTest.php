<?php

namespace Tests;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Stagehand\Core\Util;

/**
 * @internal
 *
 * @coversNothing
 */
class ClientTest extends TestCase
{
    public function testBaseUrlUsesStagehandAPIUrlEnv(): void
    {
        $this->withEnv(
            [
                'STAGEHAND_API_URL' => 'http://localhost:5000/from-api-env',
                'STAGEHAND_BASE_URL' => 'http://localhost:5000/from-base-env',
            ],
            function (): void {
                $transporter = $this->mockTransport();

                $client = new \Stagehand\Client(
                    browserbaseAPIKey: 'My Browserbase API Key',
                    browserbaseProjectID: 'My Browserbase Project ID',
                    modelAPIKey: 'My Model API Key',
                    requestOptions: ['transporter' => $transporter],
                );

                $client->sessions->start(modelName: 'openai/gpt-5.4-mini');

                $this->assertNotFalse($requested = $transporter->getRequests()[0] ?? false);
                $this->assertSame(
                    'http://localhost:5000/from-api-env/v1/sessions/start',
                    (string) $requested->getUri()
                );
            },
        );
    }

    public function testBaseUrlUsesLegacyStagehandBaseUrlEnv(): void
    {
        $this->withEnv(
            [
                'STAGEHAND_API_URL' => null,
                'STAGEHAND_BASE_URL' => 'http://localhost:5000/from-base-env',
            ],
            function (): void {
                $transporter = $this->mockTransport();

                $client = new \Stagehand\Client(
                    browserbaseAPIKey: 'My Browserbase API Key',
                    browserbaseProjectID: 'My Browserbase Project ID',
                    modelAPIKey: 'My Model API Key',
                    requestOptions: ['transporter' => $transporter],
                );

                $client->sessions->start(modelName: 'openai/gpt-5.4-mini');

                $this->assertNotFalse($requested = $transporter->getRequests()[0] ?? false);
                $this->assertSame(
                    'http://localhost:5000/from-base-env/v1/sessions/start',
                    (string) $requested->getUri()
                );
            },
        );
    }

    public function testDefaultHeaders(): void
    {
        $transporter = $this->mockTransport();

        $client = new \Stagehand\Client(
            baseUrl: 'http://localhost',
            browserbaseAPIKey: 'My Browserbase API Key',
            browserbaseProjectID: 'My Browserbase Project ID',
            modelAPIKey: 'My Model API Key',
            requestOptions: ['transporter' => $transporter],
        );

        $client->sessions->start(modelName: 'openai/gpt-5.4-mini');

        $this->assertNotFalse($requested = $transporter->getRequests()[0] ?? false);

        foreach (['accept', 'content-type'] as $header) {
            $sent = $requested->getHeaderLine($header);
            $this->assertNotEmpty($sent);
        }
    }

    public function testProjectIDHeaderIsOmitted(): void
    {
        $transporter = $this->mockTransport();

        $client = new \Stagehand\Client(
            baseUrl: 'http://localhost',
            browserbaseAPIKey: 'My Browserbase API Key',
            browserbaseProjectID: 'My Browserbase Project ID',
            modelAPIKey: 'My Model API Key',
            requestOptions: ['transporter' => $transporter],
        );

        $client->sessions->start(modelName: 'openai/gpt-5.4-mini');

        $this->assertNotFalse($requested = $transporter->getRequests()[0] ?? false);
        $this->assertSame('', $requested->getHeaderLine('x-bb-project-id'));
    }

    private function mockTransport(): Client
    {
        $transporter = new Client;
        $mockRsp = Psr17FactoryDiscovery::findResponseFactory()
            ->createResponse()
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(json_encode([], flags: Util::JSON_ENCODE_FLAGS) ?: ''))
        ;

        $transporter->setDefaultResponse($mockRsp);

        return $transporter;
    }

    /**
     * @param array<string, string|null> $vars
     */
    private function withEnv(array $vars, callable $callback): void
    {
        $oldValues = [];
        foreach ($vars as $key => $_) {
            $value = getenv($key);
            $oldValues[$key] = false === $value ? null : $value;
        }

        try {
            foreach ($vars as $key => $value) {
                null === $value ? putenv($key) : putenv("{$key}={$value}");
            }

            $callback();
        } finally {
            foreach ($oldValues as $key => $value) {
                null === $value ? putenv($key) : putenv("{$key}={$value}");
            }
        }
    }
}
