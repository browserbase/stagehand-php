<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionExecuteParams\AgentConfig\ExecutionModel\AzureEntraModelConfigObject;

use Stagehand\Core\Attributes\Required;
use Stagehand\Core\Concerns\SdkModel;
use Stagehand\Core\Contracts\BaseModel;

/**
 * Azure provider authentication configuration.
 *
 * @phpstan-type AuthShape = array{token: string, type: 'azureEntraId'}
 */
final class Auth implements BaseModel
{
    /** @use SdkModel<AuthShape> */
    use SdkModel;

    /**
     * Use a Microsoft Entra ID bearer token for authentication.
     *
     * @var 'azureEntraId' $type
     */
    #[Required]
    public string $type = 'azureEntraId';

    /**
     * Microsoft Entra ID bearer token for Azure OpenAI.
     */
    #[Required]
    public string $token;

    /**
     * `new Auth()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Auth::with(token: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Auth)->withToken(...)
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
    public static function with(string $token): self
    {
        $self = new self;

        $self['token'] = $token;

        return $self;
    }

    /**
     * Microsoft Entra ID bearer token for Azure OpenAI.
     */
    public function withToken(string $token): self
    {
        $self = clone $this;
        $self['token'] = $token;

        return $self;
    }

    /**
     * Use a Microsoft Entra ID bearer token for authentication.
     *
     * @param 'azureEntraId' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
