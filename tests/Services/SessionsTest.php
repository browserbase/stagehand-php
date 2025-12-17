<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stagehand\Client;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class SessionsTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(
            browserbaseAPIKey: 'My Browserbase API Key',
            browserbaseProjectID: 'My Browserbase Project ID',
            modelAPIKey: 'My Model API Key',
            baseUrl: $testUrl,
        );

        $this->client = $client;
    }

    #[Test]
    public function testAct(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->act((object) []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsNotResource($result);
    }

    #[Test]
    public function testEnd(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->end((object) []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsNotResource($result);
    }

    #[Test]
    public function testExecuteAgent(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->executeAgent((object) []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsNotResource($result);
    }

    #[Test]
    public function testExtract(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->extract((object) []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsNotResource($result);
    }

    #[Test]
    public function testNavigate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->navigate((object) []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsNotResource($result);
    }

    #[Test]
    public function testObserve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->observe((object) []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsNotResource($result);
    }

    #[Test]
    public function testStart(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->start();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsNotResource($result);
    }
}
