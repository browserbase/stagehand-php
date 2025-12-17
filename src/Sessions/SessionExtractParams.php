<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Optional;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Concerns\SdkParams;
use Stagehand\Core\Contracts\BaseModel;

/**
 * Extracts structured data from the current page using AI-powered analysis.
 *
 * @see Stagehand\Services\SessionsService::extract()
 *
 * @phpstan-type SessionExtractParamsShape = array{
 *   body?: mixed,
 *   xLanguage?: mixed,
 *   xSDKVersion?: mixed,
 *   xSentAt?: mixed,
 *   xStreamResponse?: mixed,
 * }
 */
final class SessionExtractParams implements BaseModel
{
    /** @use SdkModel<SessionExtractParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public mixed $body;

    #[Optional]
    public mixed $xLanguage;

    #[Optional]
    public mixed $xSDKVersion;

    #[Optional]
    public mixed $xSentAt;

    #[Optional]
    public mixed $xStreamResponse;

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
        mixed $body = null,
        mixed $xLanguage = null,
        mixed $xSDKVersion = null,
        mixed $xSentAt = null,
        mixed $xStreamResponse = null,
    ): self {
        $self = new self;

        null !== $body && $self['body'] = $body;
        null !== $xLanguage && $self['xLanguage'] = $xLanguage;
        null !== $xSDKVersion && $self['xSDKVersion'] = $xSDKVersion;
        null !== $xSentAt && $self['xSentAt'] = $xSentAt;
        null !== $xStreamResponse && $self['xStreamResponse'] = $xStreamResponse;

        return $self;
    }

    public function withBody(mixed $body): self
    {
        $self = clone $this;
        $self['body'] = $body;

        return $self;
    }

    public function withXLanguage(mixed $xLanguage): self
    {
        $self = clone $this;
        $self['xLanguage'] = $xLanguage;

        return $self;
    }

    public function withXSDKVersion(mixed $xSDKVersion): self
    {
        $self = clone $this;
        $self['xSDKVersion'] = $xSDKVersion;

        return $self;
    }

    public function withXSentAt(mixed $xSentAt): self
    {
        $self = clone $this;
        $self['xSentAt'] = $xSentAt;

        return $self;
    }

    public function withXStreamResponse(mixed $xStreamResponse): self
    {
        $self = clone $this;
        $self['xStreamResponse'] = $xStreamResponse;

        return $self;
    }
}
