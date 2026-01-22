<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionReplayResponse\Data;

/**
 * @phpstan-import-type DataShape from \Stagehand\Sessions\SessionReplayResponse\Data
 *
 * @phpstan-type SessionReplayResponseShape = array{
 *   data: Data|DataShape, success: bool
 * }
 */
final class SessionReplayResponse implements BaseModel
{
    /** @use SdkModel<SessionReplayResponseShape> */
    use SdkModel;

    #[Required]
    public Data $data;

    /**
     * Indicates whether the request was successful.
     */
    #[Required]
    public bool $success;

    /**
     * `new SessionReplayResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SessionReplayResponse::with(data: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SessionReplayResponse)->withData(...)->withSuccess(...)
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
     * @param Data|DataShape $data
     */
    public static function with(Data|array $data, bool $success): self
    {
        $self = new self;

        $self['data'] = $data;
        $self['success'] = $success;

        return $self;
    }

    /**
     * @param Data|DataShape $data
     */
    public function withData(Data|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Indicates whether the request was successful.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
