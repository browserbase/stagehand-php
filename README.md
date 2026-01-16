<!-- x-stagehand-custom-start -->
<div id="toc" align="center" style="margin-bottom: 0;">
  <ul style="list-style: none; margin: 0; padding: 0;">
    <a href="https://stagehand.dev">
      <picture>
        <source media="(prefers-color-scheme: dark)" srcset="https://raw.githubusercontent.com/browserbase/stagehand/main/media/dark_logo.png" />
        <img alt="Stagehand" src="https://raw.githubusercontent.com/browserbase/stagehand/main/media/light_logo.png" width="200" style="margin-right: 30px;" />
      </picture>
    </a>
  </ul>
</div>
<p align="center">
  <strong>The AI Browser Automation Framework</strong><br>
  <a href="https://docs.stagehand.dev/v3/sdk/php">Read the Docs</a>
</p>

<p align="center">
  <a href="https://github.com/browserbase/stagehand/tree/main?tab=MIT-1-ov-file#MIT-1-ov-file">
    <picture>
      <source media="(prefers-color-scheme: dark)" srcset="https://raw.githubusercontent.com/browserbase/stagehand/main/media/dark_license.svg" />
      <img alt="MIT License" src="https://raw.githubusercontent.com/browserbase/stagehand/main/media/light_license.svg" />
    </picture>
  </a>
  <a href="https://stagehand.dev/discord">
    <picture>
      <source media="(prefers-color-scheme: dark)" srcset="https://raw.githubusercontent.com/browserbase/stagehand/main/media/dark_discord.svg" />
      <img alt="Discord Community" src="https://raw.githubusercontent.com/browserbase/stagehand/main/media/light_discord.svg" />
    </picture>
  </a>
</p>

<p align="center">
    <a href="https://trendshift.io/repositories/12122" target="_blank"><img src="https://trendshift.io/api/badge/repositories/12122" alt="browserbase%2Fstagehand | Trendshift" style="width: 250px; height: 55px;" width="250" height="55"/></a>
</p>

<p align="center">
If you're looking for other languages, you can find them
<a href="https://docs.stagehand.dev/v3/first-steps/introduction"> here</a>
</p>

<div align="center" style="display: flex; align-items: center; justify-content: center; gap: 4px; margin-bottom: 0;">
  <b>Vibe code</b>
  <span style="font-size: 1.05em;"> Stagehand with </span>
  <a href="https://director.ai" style="display: flex; align-items: center;">
    <span>Director</span>
  </a>
  <span> </span>
  <picture>
    <img alt="Director" src="https://raw.githubusercontent.com/browserbase/stagehand/main/media/director_icon.svg" width="25" />
  </picture>
</div>

## What is Stagehand?

Stagehand is a browser automation framework used to control web browsers with natural language and code. By combining the power of AI with the precision of code, Stagehand makes web automation flexible, maintainable, and actually reliable.

## Why Stagehand?

Most existing browser automation tools either require you to write low-level code in a framework like Selenium, Playwright, or Puppeteer, or use high-level agents that can be unpredictable in production. By letting developers choose what to write in code vs. natural language (and bridging the gap between the two) Stagehand is the natural choice for browser automations in production.

1. **Choose when to write code vs. natural language**: use AI when you want to navigate unfamiliar pages, and use code when you know exactly what you want to do.

2. **Go from AI-driven to repeatable workflows**: Stagehand lets you preview AI actions before running them, and also helps you easily cache repeatable actions to save time and tokens.

3. **Write once, run forever**: Stagehand's auto-caching combined with self-healing remembers previous actions, runs without LLM inference, and knows when to involve AI whenever the website changes and your automation breaks.
<!-- x-stagehand-custom-end -->

# Stagehand PHP API library

The Stagehand PHP library provides convenient access to the Stagehand REST API from any PHP 8.1.0+ application.

It is generated with [Stainless](https://www.stainless.com/).

## Documentation

The REST API documentation can be found on [docs.stagehand.dev](https://docs.stagehand.dev).

## Installation

To use this package, install via Composer by adding the following to your application's `composer.json`:

<!-- x-release-please-start-version -->

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:browserbase/stagehand-php.git"
    }
  ],
  "require": {
    "browserbase/stagehand": "dev-main"
  }
}
```

<!-- x-release-please-end -->

## Usage

This library uses named parameters to specify optional arguments.
Parameters with a default value must be set by name.

```php
<?php

use Stagehand\Client;

$client = new Client(
  browserbaseAPIKey: getenv('BROWSERBASE_API_KEY') ?: 'My Browserbase API Key',
  browserbaseProjectID: getenv(
    'BROWSERBASE_PROJECT_ID'
  ) ?: 'My Browserbase Project ID',
  modelAPIKey: getenv('MODEL_API_KEY') ?: 'My Model API Key',
);

$response = $client->sessions->act(
  '00000000-your-session-id-000000000000',
  input: 'click the first link on the page',
);

var_dump($response->data);
```

### Value Objects

It is recommended to use the static `with` constructor `Action::with(description: 'Click the submit button', ...)`
and named parameters to initialize value objects.

However, builders are also provided `(new Action)->withDescription('Click the submit button')`.

### Streaming

We provide support for streaming responses using Server-Sent Events (SSE).

```php
<?php

use Stagehand\Client;

$client = new Client(
  browserbaseAPIKey: getenv('BROWSERBASE_API_KEY') ?: 'My Browserbase API Key',
  browserbaseProjectID: getenv(
    'BROWSERBASE_PROJECT_ID'
  ) ?: 'My Browserbase Project ID',
  modelAPIKey: getenv('MODEL_API_KEY') ?: 'My Model API Key',
);

$stream = $client->sessions->actStream(
  '00000000-your-session-id-000000000000',
  input: 'click the first link on the page',
);

foreach ($stream as $response) {
  var_dump($response);
}
```

### Handling errors

When the library is unable to connect to the API, or if the API returns a non-success status code (i.e., 4xx or 5xx response), a subclass of `Stagehand\Core\Exceptions\APIException` will be thrown:

```php
<?php

use Stagehand\Core\Exceptions\APIConnectionException;
use Stagehand\Core\Exceptions\RateLimitException;
use Stagehand\Core\Exceptions\APIStatusException;

try {
  $response = $client->sessions->start(modelName: 'openai/gpt-5-nano');
} catch (APIConnectionException $e) {
  echo "The server could not be reached", PHP_EOL;
  var_dump($e->getPrevious());
} catch (RateLimitException $e) {
  echo "A 429 status code was received; we should back off a bit.", PHP_EOL;
} catch (APIStatusException $e) {
  echo "Another non-200-range status code was received", PHP_EOL;
  echo $e->getMessage();
}
```

Error codes are as follows:

| Cause            | Error Type                     |
| ---------------- | ------------------------------ |
| HTTP 400         | `BadRequestException`          |
| HTTP 401         | `AuthenticationException`      |
| HTTP 403         | `PermissionDeniedException`    |
| HTTP 404         | `NotFoundException`            |
| HTTP 409         | `ConflictException`            |
| HTTP 422         | `UnprocessableEntityException` |
| HTTP 429         | `RateLimitException`           |
| HTTP >= 500      | `InternalServerException`      |
| Other HTTP error | `APIStatusException`           |
| Timeout          | `APITimeoutException`          |
| Network error    | `APIConnectionException`       |

### Retries

Certain errors will be automatically retried 2 times by default, with a short exponential backoff.

Connection errors (for example, due to a network connectivity problem), 408 Request Timeout, 409 Conflict, 429 Rate Limit, >=500 Internal errors, and timeouts will all be retried by default.

You can use the `maxRetries` option to configure or disable this:

```php
<?php

use Stagehand\Client;

// Configure the default for all requests:
$client = new Client(requestOptions: ['maxRetries' => 0]);

// Or, configure per-request:
$result = $client->sessions->start(
  modelName: 'openai/gpt-5-nano', requestOptions: ['maxRetries' => 5]
);
```

## Advanced concepts

### Making custom or undocumented requests

#### Undocumented properties

You can send undocumented parameters to any endpoint, and read undocumented response properties, like so:

Note: the `extra*` parameters of the same name overrides the documented parameters.

```php
<?php

$response = $client->sessions->start(
  modelName: 'openai/gpt-5-nano',
  requestOptions: [
    'extraQueryParams' => ['my_query_parameter' => 'value'],
    'extraBodyParams' => ['my_body_parameter' => 'value'],
    'extraHeaders' => ['my-header' => 'value'],
  ],
);
```

#### Undocumented request params

If you want to explicitly send an extra param, you can do so with the `extra_query`, `extra_body`, and `extra_headers` under the `request_options:` parameter when making a request, as seen in the examples above.

#### Undocumented endpoints

To make requests to undocumented endpoints while retaining the benefit of auth, retries, and so on, you can make requests using `client.request`, like so:

```php
<?php

$response = $client->request(
  method: "post",
  path: '/undocumented/endpoint',
  query: ['dog' => 'woof'],
  headers: ['useful-header' => 'interesting-value'],
  body: ['hello' => 'world']
);
```

## Versioning

This package follows [SemVer](https://semver.org/spec/v2.0.0.html) conventions. As the library is in initial development and has a major version of `0`, APIs may change at any time.

This package considers improvements to the (non-runtime) PHPDoc type definitions to be non-breaking changes.

## Requirements

PHP 8.1.0 or higher.

## Contributing

See [the contributing documentation](https://github.com/browserbase/stagehand-php/tree/main/CONTRIBUTING.md).
