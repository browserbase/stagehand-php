<?php

namespace StagehandSDK\Core\Concerns;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use StagehandSDK\Core\Contracts\BaseStream;
use StagehandSDK\Core\Conversion\Contracts\Converter;
use StagehandSDK\Core\Conversion\Contracts\ConverterSource;
use StagehandSDK\Core\Implementation\IteratorExit;

/**
 * @internal
 *
 * @template TRaw mixed
 * @template TEvent
 *
 * @implements BaseStream<TEvent>
 */
trait SdkStream
{
    /** @var \Generator<TRaw> */
    protected \Generator $stream;

    /** @var \Generator<TEvent> */
    private \Generator $generator;

    public function __construct(
        protected string|Converter|ConverterSource $convert,
        protected RequestInterface $request,
        protected ResponseInterface $response,
        protected mixed $parsedBody,
    ) {
        // @phpstan-ignore-next-line
        $this->stream = $parsedBody;
        $this->generator = $this->parsedGenerator();
    }

    /** @return \Iterator<TEvent> */
    public function getIterator(): \Iterator
    {
        return $this->generator;
    }

    public function close(): void
    {
        try {
            $this->stream->throw(new IteratorExit);
        } catch (IteratorExit $_) {
            // IteratorExit shouldn't be noticed.
            return;
        }
    }

    /** @return \Generator<TEvent> $stream */
    abstract private function parsedGenerator(): \Generator;
}
