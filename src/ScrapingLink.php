<?php

namespace Scrapinglink\PhpScrapingLink;

use Scrapinglink\PhpScrapingLink\Client\ScrapeResponse;
use Scrapinglink\PhpScrapingLink\Client\ScrapingLinkClient;

class ScrapingLink
{
    const SL_API_BASE_URI = 'https://app.scraping.link';
    const DEFAULT_TIMEOUT_SECONDS = 30;

    private ScrapingLinkClient $scrapingLinkClient;

    public function __construct(string $apiToken)
    {
        $this->scrapingLinkClient = new ScrapingLinkClient(self::SL_API_BASE_URI, self::DEFAULT_TIMEOUT_SECONDS, $apiToken);
    }

    public function scrape(string $url, bool $renderJs = false): ScrapeResponse
    {
        $response = $this->scrapingLinkClient->makeGetRequest(
            '/api/scrape',
            [
                'render' => $renderJs ? '1' : '0',
                'url' => $url,
            ]
        );

        return new ScrapeResponse($response);
    }
}
