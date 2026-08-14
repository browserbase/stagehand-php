<?php

declare(strict_types=1);

namespace Stagehand\Sessions\SessionObserveParams\Options\Model\GenericModelConfigObject;

/**
 * Wire format used by an OpenAI-compatible endpoint. Defaults to the Responses API; use chat for Chat Completions-only endpoints.
 */
enum OpenAIEndpointFormat: string
{
    case RESPONSES = 'responses';

    case CHAT = 'chat';
}
