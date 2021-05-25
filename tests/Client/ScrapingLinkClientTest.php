<?php

namespace Scrapinglink\PhpScrapingLink\Tests\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Scrapinglink\PhpScrapingLink\Client\Exceptions\InvalidApiTokenException;
use Scrapinglink\PhpScrapingLink\Client\Exceptions\PlanLimitException;
use Scrapinglink\PhpScrapingLink\Client\ScrapingLinkClient;

class ScrapingLinkClientTest extends TestCase
{
    /** @test */
    public function it_makes_a_get_request_successfully()
    {
        $scrapingLinkClient = $this->getScrapingLinkClientWithMockedGuzzle(200, '<html>HTML Content</html>');
        $response = $scrapingLinkClient->makeGetRequest('/api/endpoint', ['param1' => 'value1']);

        $this->assertSame(200, $response->getStatusCode());
    }

    /** @test */
    public function it_throws_an_invalid_api_token_exception_when_response_is_401()
    {
        $this->expectException(InvalidApiTokenException::class);

        $scrapingLinkClient = $this->getScrapingLinkClientWithMockedGuzzle(401, '<html>Unauthenticated</html>');
        $scrapingLinkClient->makeGetRequest('/api/endpoint', ['param1' => 'value1']);
    }

    /** @test */
    public function it_throws_a_plan_limit_exception_when_response_is_402()
    {
        $this->expectException(PlanLimitException::class);

        $scrapingLinkClient = $this->getScrapingLinkClientWithMockedGuzzle(402, '<html>Unauthenticated</html>');
        $scrapingLinkClient->makeGetRequest('/api/endpoint', ['param1' => 'value1']);
    }

    protected function getScrapingLinkClientWithMockedGuzzle(int $status, string $jsonBody): ScrapingLinkClient
    {
        return new class($status, $jsonBody) extends ScrapingLinkClient {
            private int $status;
            private string $body;

            public function __construct(int $status, string $body)
            {
                $this->status = $status;
                $this->body = $body;

                parent::__construct('base-uri', 30, 'api-token');
            }

            protected function getGuzzleClient(string $baseUri, int $timeout): Client
            {
                $mock = new MockHandler([
                    new Response($this->status, [], $this->body),
                ]);

                $handlerStack = HandlerStack::create($mock);

                return new Client(['handler' => $handlerStack]);
            }
        };
    }
}
