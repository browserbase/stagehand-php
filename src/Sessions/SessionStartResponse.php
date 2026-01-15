<?php

declare(strict_types=1);

namespace StagehandSDK\Sessions;

use StagehandSDK\Core\Attributes\Required;
use StagehandSDK\Core\Concerns\SdkModel;
use StagehandSDK\Core\Contracts\BaseModel;
use StagehandSDK\Sessions\SessionStartResponse\Data;

/**
 * @phpstan-import-type DataShape from \StagehandSDK\Sessions\SessionStartResponse\Data
 *
 * @phpstan-type SessionStartResponseShape = array{
 *   data: Data|DataShape, success: bool
 * }
 */
final class SessionStartResponse implements BaseModel
{
    /** @use SdkModel<SessionStartResponseShape> */
    use SdkModel;

    #[Required]
    public Data $data;

    /**
     * Indicates whether the request was successful.
     */
    #[Required]
    public bool $success;

    /**
     * `new SessionStartResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SessionStartResponse::with(data: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SessionStartResponse)->withData(...)->withSuccess(...)
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
