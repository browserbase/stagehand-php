<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Concerns\SdkParams;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionExecuteAgentParams\AgentConfig;
use Stagehand\Sessions\SessionExecuteAgentParams\AgentConfig\Provider;
use Stagehand\Sessions\SessionExecuteAgentParams\ExecuteOptions;
use Stagehand\Sessions\SessionExecuteAgentParams\XStreamResponse;

/**
 * Runs an autonomous agent that can perform multiple actions to
 * complete a complex task.
 *
 * @see Stagehand\Services\SessionsService::executeAgent()
 *
 * @phpstan-type SessionExecuteAgentParamsShape = array{
 *   agentConfig: AgentConfig|array{
 *     cua?: bool|null,
 *     model?: string|null|ModelConfig,
 *     provider?: value-of<Provider>|null,
 *     systemPrompt?: string|null,
 *   },
 *   executeOptions: ExecuteOptions|array{
 *     instruction: string, highlightCursor?: bool|null, maxSteps?: int|null
 *   },
 *   frameID?: string,
 *   xStreamResponse?: XStreamResponse|value-of<XStreamResponse>,
 * }
 */
final class SessionExecuteAgentParams implements BaseModel
{
    /** @use SdkModel<SessionExecuteAgentParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public AgentConfig $agentConfig;

    #[Required]
    public ExecuteOptions $executeOptions;

    #[Optional('frameId')]
    public ?string $frameID;

    /** @var value-of<XStreamResponse>|null $xStreamResponse */
    #[Optional(enum: XStreamResponse::class)]
    public ?string $xStreamResponse;

    /**
     * `new SessionExecuteAgentParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SessionExecuteAgentParams::with(agentConfig: ..., executeOptions: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SessionExecuteAgentParams)->withAgentConfig(...)->withExecuteOptions(...)
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
     * @param AgentConfig|array{
     *   cua?: bool|null,
     *   model?: string|ModelConfig|null,
     *   provider?: value-of<Provider>|null,
     *   systemPrompt?: string|null,
     * } $agentConfig
     * @param ExecuteOptions|array{
     *   instruction: string, highlightCursor?: bool|null, maxSteps?: int|null
     * } $executeOptions
     * @param XStreamResponse|value-of<XStreamResponse> $xStreamResponse
     */
    public static function with(
        AgentConfig|array $agentConfig,
        ExecuteOptions|array $executeOptions,
        ?string $frameID = null,
        XStreamResponse|string|null $xStreamResponse = null,
    ): self {
        $self = new self;

        $self['agentConfig'] = $agentConfig;
        $self['executeOptions'] = $executeOptions;

        null !== $frameID && $self['frameID'] = $frameID;
        null !== $xStreamResponse && $self['xStreamResponse'] = $xStreamResponse;

        return $self;
    }

    /**
     * @param AgentConfig|array{
     *   cua?: bool|null,
     *   model?: string|ModelConfig|null,
     *   provider?: value-of<Provider>|null,
     *   systemPrompt?: string|null,
     * } $agentConfig
     */
    public function withAgentConfig(AgentConfig|array $agentConfig): self
    {
        $self = clone $this;
        $self['agentConfig'] = $agentConfig;

        return $self;
    }

    /**
     * @param ExecuteOptions|array{
     *   instruction: string, highlightCursor?: bool|null, maxSteps?: int|null
     * } $executeOptions
     */
    public function withExecuteOptions(
        ExecuteOptions|array $executeOptions
    ): self {
        $self = clone $this;
        $self['executeOptions'] = $executeOptions;

        return $self;
    }

    public function withFrameID(string $frameID): self
    {
        $self = clone $this;
        $self['frameID'] = $frameID;

        return $self;
    }

    /**
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
