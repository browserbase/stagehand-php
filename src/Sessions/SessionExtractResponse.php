<?php

declare(strict_types=1);

namespace Stagehand\Sessions;

use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;
use Stagehand\Sessions\SessionExtractResponse\Data;

/**
 * @phpstan-import-type DataShape from \Stagehand\Sessions\SessionExtractResponse\Data
 *
 * @phpstan-type SessionExtractResponseShape = array{
 *   data: Data|DataShape, success: bool
 * }
 */
final class SessionExtractResponse implements BaseModel
{
    /** @use SdkModel<SessionExtractResponseShape> */
    use SdkModel;

    #[Required]
    public Data $data;

    /**
     * Indicates whether the request was successful.
     */
    #[Required]
    public bool $success;

    /**
     * `new SessionExtractResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SessionExtractResponse::with(data: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SessionExtractResponse)->withData(...)->withSuccess(...)
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
     * @param DataShape $data
     */
    public static function with(Data|array $data, bool $success): self
    {
        $self = new self;

        $self['data'] = $data;
        $self['success'] = $success;

        return $self;
    }

    /**
     * @param DataShape $data
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
