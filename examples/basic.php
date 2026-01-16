<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Stagehand\Client;
use Stagehand\Sessions\Action;

// Load environment variables from .env file if it exists
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = parse_ini_file(__DIR__ . '/../.env');
    foreach ($dotenv as $key => $value) {
        if (!getenv($key)) {
            putenv("$key=$value");
        }
    }
}

// Initialize the Stagehand client with API keys from environment variables
$client = new Client(
    browserbaseAPIKey: getenv('BROWSERBASE_API_KEY') ?: throw new Exception('BROWSERBASE_API_KEY environment variable is required'),
    browserbaseProjectID: getenv('BROWSERBASE_PROJECT_ID') ?: throw new Exception('BROWSERBASE_PROJECT_ID environment variable is required'),
    modelAPIKey: getenv('MODEL_API_KEY') ?: throw new Exception('MODEL_API_KEY environment variable is required'),
);

// Start a new session
$startResponse = $client->sessions->start(
    browserbaseAPIKey: getenv('BROWSERBASE_API_KEY'),
    browserbaseProjectID: getenv('BROWSERBASE_PROJECT_ID'),
    model: 'openai/gpt-4o',
);
echo "Session started: {$startResponse->data->sessionID}\n";

$sessionID = $startResponse->data->sessionID;

// Navigate to Hacker News
$client->sessions->navigate(
    $sessionID,
    url: 'https://news.ycombinator.com',
);
echo "Navigated to Hacker News\n";

// Observe to find possible actions
$observeResponse = $client->sessions->observe(
    $sessionID,
    instruction: 'find the link to view comments for the top post',
);

$actions = $observeResponse->data->result;
echo "Found " . count($actions) . " possible actions\n";

if (count($actions) === 0) {
    echo "No actions found\n";
    exit(0);
}

// Use the first action
$action = $actions[0];
echo "Acting on: {$action->description}\n";

// Pass the action to Act
$actResponse = $client->sessions->act(
    $sessionID,
    input: Action::with(
        description: $action->description,
        selector: $action->selector,
        method: $action->method,
        arguments: $action->arguments,
    ),
);
echo "Act completed: {$actResponse->data->result->message}\n";

// Extract data from the page
// We're now on the comments page, so extract the top comment text
$extractResponse = $client->sessions->extract(
    $sessionID,
    instruction: 'extract the text of the top comment on this page',
    schema: [
        'type' => 'object',
        'properties' => [
            'commentText' => [
                'type' => 'string',
                'description' => 'The text content of the top comment',
            ],
            'author' => [
                'type' => 'string',
                'description' => 'The username of the comment author',
            ],
        ],
        'required' => ['commentText'],
    ],
);
echo "Extracted data: " . json_encode($extractResponse->data->result) . "\n";

// Get the author from the extracted data
$extractedData = $extractResponse->data->result;
$author = $extractedData['author'] ?? 'unknown';
echo "Looking up profile for author: $author\n";

// Use the Agent to find the author's profile
// Execute runs an autonomous agent that can navigate and interact with pages
$executeResponse = $client->sessions->executeAgent(
    $sessionID,
    agentConfig: [
        'model' => 'openai/gpt-4.1-mini',
        'cua' => false,
    ],
    executeOptions: [
        'instruction' => "Find any personal website, GitHub, LinkedIn, or other best profile URL for the Hacker News user '$author'. " .
            "Click on their username to go to their profile page and look for any links they have shared. " .
            "Use Google Search with their username or other details from their profile if you dont find any direct links.",
        'maxSteps' => 15,
    ],
);
echo "Agent completed: {$executeResponse->data->result->message}\n";
echo "Agent success: " . ($executeResponse->data->result->success ? 'true' : 'false') . "\n";
echo "Agent actions taken: " . count($executeResponse->data->result->actions) . "\n";

// End the session to clean up resources
$client->sessions->end($sessionID);
echo "Session ended\n";
