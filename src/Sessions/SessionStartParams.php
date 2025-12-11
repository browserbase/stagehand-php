<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Concerns\SdkParams;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionStartParams\Env;
use Stagehand\Sessions\SessionStartParams\LocalBrowserLaunchOptions;

/**
 * Initializes a new Stagehand session with a browser instance.
 * Returns a session ID that must be used for all subsequent requests.
 *
 * @see Stagehand\Services\SessionsService::start()
 *
 * @phpstan-type SessionStartParamsShape = array{
 *   env: Env|value-of<Env>,
 *   apiKey?: string,
 *   domSettleTimeout?: int,
 *   localBrowserLaunchOptions?: LocalBrowserLaunchOptions|array{
 *     headless?: bool|null
 *   },
 *   model?: string,
 *   projectID?: string,
 *   selfHeal?: bool,
 *   systemPrompt?: string,
 *   verbose?: int,
 * }
 */
final class SessionStartParams implements BaseModel
{
    /** @use SdkModel<SessionStartParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Environment to run the browser in.
     *
     * @var value-of<Env> $env
     */
    #[Required(enum: Env::class)]
    public string $env;

    /**
     * API key for Browserbase (required when env=BROWSERBASE).
     */
    #[Optional]
    public ?string $apiKey;

    /**
     * Timeout in ms to wait for DOM to settle.
     */
    #[Optional]
    public ?int $domSettleTimeout;

    /**
     * Options for local browser launch.
     */
    #[Optional]
    public ?LocalBrowserLaunchOptions $localBrowserLaunchOptions;

    /**
     * AI model to use for actions.
     */
    #[Optional]
    public ?string $model;

    /**
     * Project ID for Browserbase (required when env=BROWSERBASE).
     */
    #[Optional('projectId')]
    public ?string $projectID;

    /**
     * Enable self-healing for failed actions.
     */
    #[Optional]
    public ?bool $selfHeal;

    /**
     * Custom system prompt for AI actions.
     */
    #[Optional]
    public ?string $systemPrompt;

    /**
     * Logging verbosity level.
     */
    #[Optional]
    public ?int $verbose;

    /**
     * `new SessionStartParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SessionStartParams::with(env: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SessionStartParams)->withEnv(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Env|value-of<Env> $env
     * @param LocalBrowserLaunchOptions|array{
     *   headless?: bool|null
     * } $localBrowserLaunchOptions
     */
    public static function with(
        Env|string $env,
        ?string $apiKey = null,
        ?int $domSettleTimeout = null,
        LocalBrowserLaunchOptions|array|null $localBrowserLaunchOptions = null,
        ?string $model = null,
        ?string $projectID = null,
        ?bool $selfHeal = null,
        ?string $systemPrompt = null,
        ?int $verbose = null,
    ): self {
        $self = new self;

        $self['env'] = $env;

        null !== $apiKey && $self['apiKey'] = $apiKey;
        null !== $domSettleTimeout && $self['domSettleTimeout'] = $domSettleTimeout;
        null !== $localBrowserLaunchOptions && $self['localBrowserLaunchOptions'] = $localBrowserLaunchOptions;
        null !== $model && $self['model'] = $model;
        null !== $projectID && $self['projectID'] = $projectID;
        null !== $selfHeal && $self['selfHeal'] = $selfHeal;
        null !== $systemPrompt && $self['systemPrompt'] = $systemPrompt;
        null !== $verbose && $self['verbose'] = $verbose;

        return $self;
    }

    /**
     * Environment to run the browser in.
     *
     * @param Env|value-of<Env> $env
     */
    public function withEnv(Env|string $env): self
    {
        $self = clone $this;
        $self['env'] = $env;

        return $self;
    }

    /**
     * API key for Browserbase (required when env=BROWSERBASE).
     */
    public function withAPIKey(string $apiKey): self
    {
        $self = clone $this;
        $self['apiKey'] = $apiKey;

        return $self;
    }

    /**
     * Timeout in ms to wait for DOM to settle.
     */
    public function withDomSettleTimeout(int $domSettleTimeout): self
    {
        $self = clone $this;
        $self['domSettleTimeout'] = $domSettleTimeout;

        return $self;
    }

    /**
     * Options for local browser launch.
     *
     * @param LocalBrowserLaunchOptions|array{
     *   headless?: bool|null
     * } $localBrowserLaunchOptions
     */
    public function withLocalBrowserLaunchOptions(
        LocalBrowserLaunchOptions|array $localBrowserLaunchOptions
    ): self {
        $self = clone $this;
        $self['localBrowserLaunchOptions'] = $localBrowserLaunchOptions;

        return $self;
    }

    /**
     * AI model to use for actions.
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Project ID for Browserbase (required when env=BROWSERBASE).
     */
    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    /**
     * Enable self-healing for failed actions.
     */
    public function withSelfHeal(bool $selfHeal): self
    {
        $self = clone $this;
        $self['selfHeal'] = $selfHeal;

        return $self;
    }

    /**
     * Custom system prompt for AI actions.
     */
    public function withSystemPrompt(string $systemPrompt): self
    {
        $self = clone $this;
        $self['systemPrompt'] = $systemPrompt;

        return $self;
    }

    /**
     * Logging verbosity level.
     */
    public function withVerbose(int $verbose): self
    {
        $self = clone $this;
        $self['verbose'] = $verbose;

        return $self;
    }
}
