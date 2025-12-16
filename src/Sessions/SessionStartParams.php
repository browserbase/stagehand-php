<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Concerns\SdkParams;
use Stagehand\Core\Contracts\BaseModel;

/**
 * Initializes a new Stagehand session with a browser instance.
 * Returns a session ID that must be used for all subsequent requests.
 *
 * @see Stagehand\Services\SessionsService::start()
 *
 * @phpstan-type SessionStartParamsShape = array{
 *   browserbaseAPIKey: string,
 *   browserbaseProjectID: string,
 *   domSettleTimeout?: int,
 *   model?: string,
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
     * API key for Browserbase Cloud.
     */
    #[Required('BROWSERBASE_API_KEY')]
    public string $browserbaseAPIKey;

    /**
     * Project ID for Browserbase.
     */
    #[Required('BROWSERBASE_PROJECT_ID')]
    public string $browserbaseProjectID;

    /**
     * Timeout in ms to wait for DOM to settle.
     */
    #[Optional]
    public ?int $domSettleTimeout;

    /**
     * AI model to use for actions (must be prefixed with provider/).
     */
    #[Optional]
    public ?string $model;

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
     * SessionStartParams::with(browserbaseAPIKey: ..., browserbaseProjectID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SessionStartParams)
     *   ->withBrowserbaseAPIKey(...)
     *   ->withBrowserbaseProjectID(...)
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
     */
    public static function with(
        string $browserbaseAPIKey,
        string $browserbaseProjectID,
        ?int $domSettleTimeout = null,
        ?string $model = null,
        ?bool $selfHeal = null,
        ?string $systemPrompt = null,
        ?int $verbose = null,
    ): self {
        $self = new self;

        $self['browserbaseAPIKey'] = $browserbaseAPIKey;
        $self['browserbaseProjectID'] = $browserbaseProjectID;

        null !== $domSettleTimeout && $self['domSettleTimeout'] = $domSettleTimeout;
        null !== $model && $self['model'] = $model;
        null !== $selfHeal && $self['selfHeal'] = $selfHeal;
        null !== $systemPrompt && $self['systemPrompt'] = $systemPrompt;
        null !== $verbose && $self['verbose'] = $verbose;

        return $self;
    }

    /**
     * API key for Browserbase Cloud.
     */
    public function withBrowserbaseAPIKey(string $browserbaseAPIKey): self
    {
        $self = clone $this;
        $self['browserbaseAPIKey'] = $browserbaseAPIKey;

        return $self;
    }

    /**
     * Project ID for Browserbase.
     */
    public function withBrowserbaseProjectID(string $browserbaseProjectID): self
    {
        $self = clone $this;
        $self['browserbaseProjectID'] = $browserbaseProjectID;

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
     * AI model to use for actions (must be prefixed with provider/).
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

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
