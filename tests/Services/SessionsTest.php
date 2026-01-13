<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stagehand\Client;
use Stagehand\Sessions\SessionActResponse;
use Stagehand\Sessions\SessionEndResponse;
use Stagehand\Sessions\SessionExecuteAgentResponse;
use Stagehand\Sessions\SessionNavigateResponse;
use Stagehand\Sessions\SessionStartResponse;
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

        $result = $this->client->sessions->act(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e',
            input: 'click the sign in button'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SessionActResponse::class, $result);
    }

    #[Test]
    public function testActWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->act(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e',
            input: 'click the sign in button',
            options: [
                'model' => [
                    'apiKey' => 'apiKey',
                    'baseURL' => 'https://example.com',
                    'model' => 'model',
                    'provider' => 'openai',
                ],
                'timeout' => 0,
                'variables' => ['foo' => 'string'],
            ],
            xStreamResponse: 'true',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SessionActResponse::class, $result);
    }

    #[Test]
    public function testEnd(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->end(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SessionEndResponse::class, $result);
    }

    #[Test]
    public function testExecuteAgent(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->executeAgent(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e',
            agentConfig: [],
            executeOptions: ['instruction' => 'Find and click the first product'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SessionExecuteAgentResponse::class, $result);
    }

    #[Test]
    public function testExecuteAgentWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->executeAgent(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e',
            agentConfig: [
                'cua' => true,
                'model' => 'openai/gpt-4o',
                'provider' => 'openai',
                'systemPrompt' => 'systemPrompt',
            ],
            executeOptions: [
                'instruction' => 'Find and click the first product',
                'highlightCursor' => true,
                'maxSteps' => 10,
            ],
            xStreamResponse: 'true',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SessionExecuteAgentResponse::class, $result);
    }

    #[Test]
    public function testExtract(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->extract(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testNavigate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->navigate(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e',
            url: 'https://example.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SessionNavigateResponse::class, $result);
    }

    #[Test]
    public function testNavigateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->navigate(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e',
            url: 'https://example.com',
            options: ['waitUntil' => 'load'],
            xStreamResponse: 'true',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SessionNavigateResponse::class, $result);
    }

    #[Test]
    public function testObserve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->observe(
            '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsList($result);
    }

    #[Test]
    public function testStart(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->start(
            browserbaseAPIKey: 'BROWSERBASE_API_KEY',
            browserbaseProjectID: 'BROWSERBASE_PROJECT_ID',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SessionStartResponse::class, $result);
    }

    #[Test]
    public function testStartWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->start(
            browserbaseAPIKey: 'BROWSERBASE_API_KEY',
            browserbaseProjectID: 'BROWSERBASE_PROJECT_ID',
            domSettleTimeout: 0,
            model: 'openai/gpt-4o',
            selfHeal: true,
            systemPrompt: 'systemPrompt',
            verbose: 1,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SessionStartResponse::class, $result);
    }
}
