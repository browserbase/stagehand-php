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
 *   agentConfig: AgentConfig|AgentConfigShape,
 *   executeOptions: ExecuteOptions|ExecuteOptionsShape,
 *   frameID?: string|null,
 *   shouldCache?: bool|null,
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
    #[Optional('frameId', nullable: true)]
    public ?string $frameID;

    /**
     * If true, the server captures a cache entry and returns it to the client.
     */
    #[Optional]
    public ?bool $shouldCache;

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
     * @param AgentConfig|AgentConfigShape $agentConfig
     * @param ExecuteOptions|ExecuteOptionsShape $executeOptions
     * @param XStreamResponse|value-of<XStreamResponse>|null $xStreamResponse
     */
    public static function with(
        AgentConfig|array $agentConfig,
        ExecuteOptions|array $executeOptions,
        ?string $frameID = null,
        ?bool $shouldCache = null,
        XStreamResponse|string|null $xStreamResponse = null,
    ): self {
        $self = new self;

        $self['agentConfig'] = $agentConfig;
        $self['executeOptions'] = $executeOptions;

        null !== $frameID && $self['frameID'] = $frameID;
        null !== $shouldCache && $self['shouldCache'] = $shouldCache;
        null !== $xStreamResponse && $self['xStreamResponse'] = $xStreamResponse;

        return $self;
    }

    /**
     * @param AgentConfig|AgentConfigShape $agentConfig
     */
    public function withAgentConfig(AgentConfig|array $agentConfig): self
    {
        $self = clone $this;
        $self['agentConfig'] = $agentConfig;

        return $self;
    }

    /**
     * @param ExecuteOptions|ExecuteOptionsShape $executeOptions
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
    public function withFrameID(?string $frameID): self
    {
        $self = clone $this;
        $self['frameID'] = $frameID;

        return $self;
    }

    /**
     * If true, the server captures a cache entry and returns it to the client.
     */
    public function withShouldCache(bool $shouldCache): self
    {
        $self = clone $this;
        $self['shouldCache'] = $shouldCache;

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
