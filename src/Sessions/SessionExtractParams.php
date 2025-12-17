<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Concerns\SdkParams;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionExtractParams\Options;
use Stagehand\Sessions\SessionExtractParams\XLanguage;
use Stagehand\Sessions\SessionExtractParams\XStreamResponse;

/**
 * Extracts structured data from the current page using AI-powered analysis.
 *
 * @see Stagehand\Services\SessionsService::extract()
 *
 * @phpstan-import-type OptionsShape from \Stagehand\Sessions\SessionExtractParams\Options
 *
 * @phpstan-type SessionExtractParamsShape = array{
 *   frameID?: string|null,
 *   instruction?: string|null,
 *   options?: OptionsShape|null,
 *   schema?: array<string,mixed>|null,
 *   xLanguage?: null|XLanguage|value-of<XLanguage>,
 *   xSDKVersion?: string|null,
 *   xSentAt?: \DateTimeInterface|null,
 *   xStreamResponse?: null|XStreamResponse|value-of<XStreamResponse>,
 * }
 */
final class SessionExtractParams implements BaseModel
{
    /** @use SdkModel<SessionExtractParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Target frame ID for the extraction.
     */
    #[Optional('frameId')]
    public ?string $frameID;

    /**
     * Natural language instruction for what to extract.
     */
    #[Optional]
    public ?string $instruction;

    #[Optional]
    public ?Options $options;

    /**
     * JSON Schema defining the structure of data to extract.
     *
     * @var array<string,mixed>|null $schema
     */
    #[Optional(map: 'mixed')]
    public ?array $schema;

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

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param OptionsShape $options
     * @param array<string,mixed> $schema
     * @param XLanguage|value-of<XLanguage> $xLanguage
     * @param XStreamResponse|value-of<XStreamResponse> $xStreamResponse
     */
    public static function with(
        ?string $frameID = null,
        ?string $instruction = null,
        Options|array|null $options = null,
        ?array $schema = null,
        XLanguage|string|null $xLanguage = null,
        ?string $xSDKVersion = null,
        ?\DateTimeInterface $xSentAt = null,
        XStreamResponse|string|null $xStreamResponse = null,
    ): self {
        $self = new self;

        null !== $frameID && $self['frameID'] = $frameID;
        null !== $instruction && $self['instruction'] = $instruction;
        null !== $options && $self['options'] = $options;
        null !== $schema && $self['schema'] = $schema;
        null !== $xLanguage && $self['xLanguage'] = $xLanguage;
        null !== $xSDKVersion && $self['xSDKVersion'] = $xSDKVersion;
        null !== $xSentAt && $self['xSentAt'] = $xSentAt;
        null !== $xStreamResponse && $self['xStreamResponse'] = $xStreamResponse;

        return $self;
    }

    /**
     * Target frame ID for the extraction.
     */
    public function withFrameID(string $frameID): self
    {
        $self = clone $this;
        $self['frameID'] = $frameID;

        return $self;
    }

    /**
     * Natural language instruction for what to extract.
     */
    public function withInstruction(string $instruction): self
    {
        $self = clone $this;
        $self['instruction'] = $instruction;

        return $self;
    }

    /**
     * @param OptionsShape $options
     */
    public function withOptions(Options|array $options): self
    {
        $self = clone $this;
        $self['options'] = $options;

        return $self;
    }

    /**
     * JSON Schema defining the structure of data to extract.
     *
     * @param array<string,mixed> $schema
     */
    public function withSchema(array $schema): self
    {
        $self = clone $this;
        $self['schema'] = $schema;

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
