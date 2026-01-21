<?php

namespace Tests\Services;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Stagehand\Client;
use Stagehand\Sessions\SessionActResponse;
use Stagehand\Sessions\SessionEndResponse;
use Stagehand\Sessions\SessionExecuteResponse;
use Stagehand\Sessions\SessionExtractResponse;
use Stagehand\Sessions\SessionNavigateResponse;
use Stagehand\Sessions\SessionObserveResponse;
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
            'c4dbf3a9-9a58-4b22-8a1c-9f20f9f9e123',
            input: 'Click the login button'
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
            'c4dbf3a9-9a58-4b22-8a1c-9f20f9f9e123',
            input: 'Click the login button',
            frameID: 'frameId',
            options: [
                'model' => [
                    'modelName' => 'openai/gpt-5-nano',
                    'apiKey' => 'sk-some-openai-api-key',
                    'baseURL' => 'https://api.openai.com/v1',
                    'provider' => 'openai',
                ],
                'timeout' => 30000,
                'variables' => ['username' => 'john_doe'],
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
            'c4dbf3a9-9a58-4b22-8a1c-9f20f9f9e123'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SessionEndResponse::class, $result);
    }

    #[Test]
    public function testExecute(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->execute(
            'c4dbf3a9-9a58-4b22-8a1c-9f20f9f9e123',
            agentConfig: [],
            executeOptions: [
                'instruction' => 'Log in with username \'demo\' and password \'test123\', then navigate to settings',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SessionExecuteResponse::class, $result);
    }

    #[Test]
    public function testExecuteWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->execute(
            'c4dbf3a9-9a58-4b22-8a1c-9f20f9f9e123',
            agentConfig: [
                'cua' => true,
                'model' => [
                    'modelName' => 'openai/gpt-5-nano',
                    'apiKey' => 'sk-some-openai-api-key',
                    'baseURL' => 'https://api.openai.com/v1',
                    'provider' => 'openai',
                ],
                'provider' => 'openai',
                'systemPrompt' => 'systemPrompt',
            ],
            executeOptions: [
                'instruction' => 'Log in with username \'demo\' and password \'test123\', then navigate to settings',
                'highlightCursor' => true,
                'maxSteps' => 20,
            ],
            frameID: 'frameId',
            shouldCache: true,
            xStreamResponse: 'true',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SessionExecuteResponse::class, $result);
    }

    #[Test]
    public function testExtract(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->extract(
            'c4dbf3a9-9a58-4b22-8a1c-9f20f9f9e123'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SessionExtractResponse::class, $result);
    }

    #[Test]
    public function testNavigate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->navigate(
            'c4dbf3a9-9a58-4b22-8a1c-9f20f9f9e123',
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
            'c4dbf3a9-9a58-4b22-8a1c-9f20f9f9e123',
            url: 'https://example.com',
            frameID: 'frameId',
            options: [
                'referer' => 'referer', 'timeout' => 30000, 'waitUntil' => 'networkidle',
            ],
            streamResponse: true,
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
            'c4dbf3a9-9a58-4b22-8a1c-9f20f9f9e123'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SessionObserveResponse::class, $result);
    }

    #[Test]
    public function testStart(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->sessions->start(modelName: 'openai/gpt-4o');

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
            modelName: 'openai/gpt-4o',
            actTimeoutMs: 0,
            browser: [
                'cdpURL' => 'ws://localhost:9222',
                'launchOptions' => [
                    'acceptDownloads' => true,
                    'args' => ['string'],
                    'cdpURL' => 'cdpUrl',
                    'chromiumSandbox' => true,
                    'connectTimeoutMs' => 0,
                    'deviceScaleFactor' => 0,
                    'devtools' => true,
                    'downloadsPath' => 'downloadsPath',
                    'executablePath' => 'executablePath',
                    'hasTouch' => true,
                    'headless' => true,
                    'ignoreDefaultArgs' => true,
                    'ignoreHTTPSErrors' => true,
                    'locale' => 'locale',
                    'port' => 0,
                    'preserveUserDataDir' => true,
                    'proxy' => [
                        'server' => 'server',
                        'bypass' => 'bypass',
                        'password' => 'password',
                        'username' => 'username',
                    ],
                    'userDataDir' => 'userDataDir',
                    'viewport' => ['height' => 0, 'width' => 0],
                ],
                'type' => 'local',
            ],
            browserbaseSessionCreateParams: [
                'browserSettings' => [
                    'advancedStealth' => true,
                    'blockAds' => true,
                    'context' => ['id' => 'id', 'persist' => true],
                    'extensionID' => 'extensionId',
                    'fingerprint' => [
                        'browsers' => ['chrome'],
                        'devices' => ['desktop'],
                        'httpVersion' => '1',
                        'locales' => ['string'],
                        'operatingSystems' => ['android'],
                        'screen' => [
                            'maxHeight' => 0,
                            'maxWidth' => 0,
                            'minHeight' => 0,
                            'minWidth' => 0,
                        ],
                    ],
                    'logSession' => true,
                    'recordSession' => true,
                    'solveCaptchas' => true,
                    'viewport' => ['height' => 0, 'width' => 0],
                ],
                'extensionID' => 'extensionId',
                'keepAlive' => true,
                'projectID' => 'projectId',
                'proxies' => true,
                'region' => 'us-west-2',
                'timeout' => 0,
                'userMetadata' => ['foo' => 'bar'],
            ],
            browserbaseSessionID: 'browserbaseSessionID',
            domSettleTimeoutMs: 5000,
            experimental: true,
            selfHeal: true,
            systemPrompt: 'systemPrompt',
            verbose: 1,
            waitForCaptchaSolves: true,
            xStreamResponse: 'true',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SessionStartResponse::class, $result);
    }
}
