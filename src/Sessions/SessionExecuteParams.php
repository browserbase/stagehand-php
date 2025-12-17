<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Concerns\SdkParams;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionExecuteParams\AgentConfig;
use Stagehand\Sessions\SessionExecuteParams\ExecuteOptions;
use Stagehand\Sessions\SessionExecuteParams\XLanguage;
use Stagehand\Sessions\SessionExecuteParams\XStreamResponse;

/**
 * Runs an autonomous AI agent that can perform complex multi-step browser tasks.
 *
 * @see Stagehand\Services\SessionsService::execute()
 *
 * @phpstan-import-type AgentConfigShape from \Stagehand\Sessions\SessionExecuteParams\AgentConfig
 * @phpstan-import-type ExecuteOptionsShape from \Stagehand\Sessions\SessionExecuteParams\ExecuteOptions
 *
 * @phpstan-type SessionExecuteParamsShape = array{
 *   agentConfig: AgentConfigShape,
 *   executeOptions: ExecuteOptionsShape,
 *   frameID?: string|null,
 *   xLanguage?: null|XLanguage|value-of<XLanguage>,
 *   xSDKVersion?: string|null,
 *   xSentAt?: \DateTimeInterface|null,
 *   xStreamResponse?: null|XStreamResponse|value-of<XStreamResponse>,
 * }
 */
final class SessionExecuteParams implements BaseModel
{
    /** @use SdkModel<SessionExecuteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public AgentConfig $agentConfig;

    #[Required]
    public ExecuteOptions $executeOptions;

    /**
     * Target frame ID for the agent.
     */
    #[Optional('frameId')]
    public ?string $frameID;

    /**
     * Client SDK language.
     *
     * @var value-of<XLanguage>|null $xLanguage
     */
    #[Optional(enum: XLanguage::class)]
    public ?string $xLanguage;

    /**
     * Version of the Stagehand SDK.
     */
    #[Optional]
    public ?string $xSDKVersion;

    /**
     * ISO timestamp when request was sent.
     */
    #[Optional]
    public ?\DateTimeInterface $xSentAt;

    /**
     * Whether to stream the response via SSE.
     *
     * @var value-of<XStreamResponse>|null $xStreamResponse
     */
    #[Optional(enum: XStreamResponse::class)]
    public ?string $xStreamResponse;

    /**
     * `new SessionExecuteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SessionExecuteParams::with(agentConfig: ..., executeOptions: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SessionExecuteParams)->withAgentConfig(...)->withExecuteOptions(...)
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
     * @param AgentConfigShape $agentConfig
     * @param ExecuteOptionsShape $executeOptions
     * @param XLanguage|value-of<XLanguage> $xLanguage
     * @param XStreamResponse|value-of<XStreamResponse> $xStreamResponse
     */
    public static function with(
        AgentConfig|array $agentConfig,
        ExecuteOptions|array $executeOptions,
        ?string $frameID = null,
        XLanguage|string|null $xLanguage = null,
        ?string $xSDKVersion = null,
        ?\DateTimeInterface $xSentAt = null,
        XStreamResponse|string|null $xStreamResponse = null,
    ): self {
        $self = new self;

        $self['agentConfig'] = $agentConfig;
        $self['executeOptions'] = $executeOptions;

        null !== $frameID && $self['frameID'] = $frameID;
        null !== $xLanguage && $self['xLanguage'] = $xLanguage;
        null !== $xSDKVersion && $self['xSDKVersion'] = $xSDKVersion;
        null !== $xSentAt && $self['xSentAt'] = $xSentAt;
        null !== $xStreamResponse && $self['xStreamResponse'] = $xStreamResponse;

        return $self;
    }

    /**
     * @param AgentConfigShape $agentConfig
     */
    public function withAgentConfig(AgentConfig|array $agentConfig): self
    {
        $self = clone $this;
        $self['agentConfig'] = $agentConfig;

        return $self;
    }

    /**
     * @param ExecuteOptionsShape $executeOptions
     */
    public function withExecuteOptions(
        ExecuteOptions|array $executeOptions
    ): self {
        $self = clone $this;
        $self['executeOptions'] = $executeOptions;

        return $self;
    }

    /**
     * Target frame ID for the agent.
     */
    public function withFrameID(string $frameID): self
    {
        $self = clone $this;
        $self['frameID'] = $frameID;

        return $self;
    }

    /**
     * Client SDK language.
     *
     * @param XLanguage|value-of<XLanguage> $xLanguage
     */
    public function withXLanguage(XLanguage|string $xLanguage): self
    {
        $self = clone $this;
        $self['xLanguage'] = $xLanguage;

        return $self;
    }

    /**
     * Version of the Stagehand SDK.
     */
    public function withXSDKVersion(string $xSDKVersion): self
    {
        $self = clone $this;
        $self['xSDKVersion'] = $xSDKVersion;

        return $self;
    }

    /**
     * ISO timestamp when request was sent.
     */
    public function withXSentAt(\DateTimeInterface $xSentAt): self
    {
        $self = clone $this;
        $self['xSentAt'] = $xSentAt;

        return $self;
    }

    /**
     * Whether to stream the response via SSE.
     *
     * @param XStreamResponse|value-of<XStreamResponse> $xStreamResponse
     */
    public function withXStreamResponse(
        XStreamResponse|string $xStreamResponse
    ): self {
        $self = clone $this;
        $self['xStreamResponse'] = $xStreamResponse;

        return $self;
    }
}
