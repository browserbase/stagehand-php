<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams;

use StagehandSDK\Core\Attributes\Optional;
use StagehandSDK\Core\Concerns\SdkModel;
use StagehandSDK\Core\Contracts\BaseModel;
use StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Context;
use StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint;
use StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Viewport;

/**
 * @phpstan-import-type ContextShape from \StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Context
 * @phpstan-import-type FingerprintShape from \StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Fingerprint
 * @phpstan-import-type ViewportShape from \StagehandSDK\Sessions\SessionStartParams\BrowserbaseSessionCreateParams\BrowserSettings\Viewport
 *
 * @phpstan-type BrowserSettingsShape = array{
 *   advancedStealth?: bool|null,
 *   blockAds?: bool|null,
 *   context?: null|Context|ContextShape,
 *   extensionID?: string|null,
 *   fingerprint?: null|Fingerprint|FingerprintShape,
 *   logSession?: bool|null,
 *   recordSession?: bool|null,
 *   solveCaptchas?: bool|null,
 *   viewport?: null|Viewport|ViewportShape,
 * }
 */
final class BrowserSettings implements BaseModel
{
    /** @use SdkModel<BrowserSettingsShape> */
    use SdkModel;

    #[Optional]
    public ?bool $advancedStealth;

    #[Optional]
    public ?bool $blockAds;

    #[Optional]
    public ?Context $context;

    #[Optional('extensionId')]
    public ?string $extensionID;

    #[Optional]
    public ?Fingerprint $fingerprint;

    #[Optional]
    public ?bool $logSession;

    #[Optional]
    public ?bool $recordSession;

    #[Optional]
    public ?bool $solveCaptchas;

    #[Optional]
    public ?Viewport $viewport;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Context|ContextShape|null $context
     * @param Fingerprint|FingerprintShape|null $fingerprint
     * @param Viewport|ViewportShape|null $viewport
     */
    public static function with(
        ?bool $advancedStealth = null,
        ?bool $blockAds = null,
        Context|array|null $context = null,
        ?string $extensionID = null,
        Fingerprint|array|null $fingerprint = null,
        ?bool $logSession = null,
        ?bool $recordSession = null,
        ?bool $solveCaptchas = null,
        Viewport|array|null $viewport = null,
    ): self {
        $self = new self;

        null !== $advancedStealth && $self['advancedStealth'] = $advancedStealth;
        null !== $blockAds && $self['blockAds'] = $blockAds;
        null !== $context && $self['context'] = $context;
        null !== $extensionID && $self['extensionID'] = $extensionID;
        null !== $fingerprint && $self['fingerprint'] = $fingerprint;
        null !== $logSession && $self['logSession'] = $logSession;
        null !== $recordSession && $self['recordSession'] = $recordSession;
        null !== $solveCaptchas && $self['solveCaptchas'] = $solveCaptchas;
        null !== $viewport && $self['viewport'] = $viewport;

        return $self;
    }

    public function withAdvancedStealth(bool $advancedStealth): self
    {
        $self = clone $this;
        $self['advancedStealth'] = $advancedStealth;

        return $self;
    }

    public function withBlockAds(bool $blockAds): self
    {
        $self = clone $this;
        $self['blockAds'] = $blockAds;

        return $self;
    }

    /**
     * @param Context|ContextShape $context
     */
    public function withContext(Context|array $context): self
    {
        $self = clone $this;
        $self['context'] = $context;

        return $self;
    }

    public function withExtensionID(string $extensionID): self
    {
        $self = clone $this;
        $self['extensionID'] = $extensionID;

        return $self;
    }

    /**
     * @param Fingerprint|FingerprintShape $fingerprint
     */
    public function withFingerprint(Fingerprint|array $fingerprint): self
    {
        $self = clone $this;
        $self['fingerprint'] = $fingerprint;

        return $self;
    }

    public function withLogSession(bool $logSession): self
    {
        $self = clone $this;
        $self['logSession'] = $logSession;

        return $self;
    }

    public function withRecordSession(bool $recordSession): self
    {
        $self = clone $this;
        $self['recordSession'] = $recordSession;

        return $self;
    }

    public function withSolveCaptchas(bool $solveCaptchas): self
    {
        $self = clone $this;
        $self['solveCaptchas'] = $solveCaptchas;

        return $self;
    }

    /**
     * @param Viewport|ViewportShape $viewport
     */
    public function withViewport(Viewport|array $viewport): self
    {
        $self = clone $this;
        $self['viewport'] = $viewport;

        return $self;
    }
}
