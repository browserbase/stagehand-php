<?php

namespace Tests\Core;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Http\Discovery\Psr17FactoryDiscovery;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stagehand\Core\BaseClient;
use Stagehand\Core\Implementation\StreamingHttpClient;
use Stagehand\RequestOptions;

/**
 * @internal
 *
 * @coversNothing
 */
#[CoversNothing]
class RequestTimeoutTest extends TestCase
{
    #[Test]
    public function testPassesPerRequestTimeoutToGuzzleTransporter(): void
    {
        [$client, $mock] = $this->buildClient();

        $client->request('GET', '/', options: ['timeout' => 1.5]);

        $this->assertSame(1.5, $mock->getLastOptions()['timeout']);
    }

    #[Test]
    public function testPassesDefaultTimeoutToGuzzleTransporter(): void
    {
        [$client, $mock] = $this->buildClient();

        $client->request('GET', '/');

        $this->assertSame((new RequestOptions)->timeout, $mock->getLastOptions()['timeout']);
    }

    #[Test]
    public function testPassesTimeoutToStreamingTransporter(): void
    {
        [$client, $mock] = $this->buildClient(streaming: true);

        $client->request('GET', '/', headers: ['Accept' => 'text/event-stream'], options: ['timeout' => 2.5]);

        $options = $mock->getLastOptions();
        $this->assertTrue($options['stream']);
        $this->assertSame(2.5, $options['timeout']);
    }

    /**
     * @return array{BaseClient, MockHandler}
     */
    private function buildClient(bool $streaming = false): array
    {
        $response = $streaming
            ? new Response(200, ['Content-Type' => 'text/event-stream'], '')
            : new Response(200, ['Content-Type' => 'application/json'], '{}');

        $mock = new MockHandler([$response]);
        $guzzle = new GuzzleClient(['handler' => HandlerStack::create($mock)]);

        $options = RequestOptions::with(
            transporter: $guzzle,
            streamingTransporter: new StreamingHttpClient($guzzle),
            uriFactory: Psr17FactoryDiscovery::findUriFactory(),
            requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
            streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
        );

        $client = new class(headers: [], baseUrl: 'http://localhost', options: $options) extends BaseClient {};

        return [$client, $mock];
    }
}
