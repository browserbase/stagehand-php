# Overview

This is a stateless SDK client for the Stagehand API provided by Browserbase.com, built using Stainless.

The Stagehand API allows users to control Browserbase cloud browsers using a natural language interface with these high-level primitives:

- `act("do xyz on this page")` - Perform actions on the page
- `observe("look for xyz elements on this page")` - Find interactive elements
- `extract("find xyz information on this page")` - Extract structured data from pages

The other calls provided are `start()` and `end()` to begin and end a browser session, and `navigate()` which is a helper to visit a specific URL.

These primitives are intended to be combined with your browser driver library of choice, e.g. php-webdriver, Panther, etc.

**Links:**

- GitHub: https://github.com/browserbase/stagehand-php
- Documentation: https://docs.stagehand.dev/v3/sdk/php
- Packagist: `browserbase/stagehand`

## Usage

Refer to the README.md "# Usage" section and `./examples` directory for detailed usage examples.

For installation instructions, see the "# Installation" section of the README.

## Common Tasks

```bash
# Install via Composer (add to composer.json)
composer require browserbase/stagehand

# Set environment variables
export BROWSERBASE_API_KEY="your-bb-api-key"
export BROWSERBASE_PROJECT_ID="your-bb-project-uuid"
export MODEL_API_KEY="sk-proj-your-llm-api-key"

# Run the example
php examples/basic.php
```

```php
// Quick start
use Stagehand\Client;

$client = new Client(
    browserbaseAPIKey: getenv('BROWSERBASE_API_KEY'),
    browserbaseProjectID: getenv('BROWSERBASE_PROJECT_ID'),
    modelAPIKey: getenv('MODEL_API_KEY'),
);
$startResponse = $client->sessions->start(model: 'openai/gpt-5-nano');
$sessionID = $startResponse->data->sessionID;
$client->sessions->navigate($sessionID, url: 'https://example.com');
$client->sessions->act($sessionID, input: 'click login');
$client->sessions->end($sessionID);
```
