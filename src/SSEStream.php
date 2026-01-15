<?php

namespace StagehandSDK;

use StagehandSDK\Core\Concerns\SdkStream;
use StagehandSDK\Core\Contracts\BaseStream;
use StagehandSDK\Core\Conversion;
use StagehandSDK\Core\Exceptions\APIStatusException;
use StagehandSDK\Core\Util;

/**
 * @template TItem
 *
 * @implements BaseStream<TItem>
 */
final class SSEStream implements BaseStream
{
    /**
     * @use SdkStream<array{
     *   event?: string|null, data?: string|null, id?: string|null, retry?: int|null
     * },
     * TItem,>
     */
    use SdkStream;

    private function parsedGenerator(): \Generator
    {
        if (!$this->stream->valid()) {
            return;
        }

        $done = false;
        foreach ($this->stream as $row) {
            // @phpstan-ignore if.alwaysFalse
            if ($done) {
                // Iterate through the whole stream
                continue;
            }

            switch ($row['event'] ?? null) {
                case null:
                    if ($data = $row['data'] ?? '') {
                        $decoded = Util::decodeJson($data);

                        yield Conversion::coerce($this->convert, value: $decoded);
                    }

                    break;
            }

            if ($data = $row['data'] ?? '') {
                if (str_starts_with($data, needle: 'finished')) {
                    $done = true;

                    continue;
                }

                if (str_starts_with($data, needle: 'error')) {
                    if ($data = $row['data'] ?? '') {
                        $json = Util::decodeJson($data);
                        $message = Util::prettyEncodeJson($json);

                        $exn = APIStatusException::from(
                            request: $this->request,
                            response: $this->response,
                            message: $message,
                        );

                        throw $exn;
                    }

                    continue;
                }
            }
        }
    }
}
