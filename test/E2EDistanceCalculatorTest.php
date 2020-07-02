<?php

declare(strict_types=1);

namespace Assignment;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

final class E2EDistanceCalculatorTest extends TestCase
{
    public function testItCanMakeARequestToCalculateTheSumOfDistances()
    {
        $httpClient = new Client();
        $uri = 'http://localhost:2323/calculate/meters';
        $d1 = ['measure'  => 'meter', 'distance' => 1.0];
        $d2 = ['measure'  => 'meter', 'distance' => 2.0];
        $expected = ['measure'  => 'meter', 'distance' => 3.0];
        $jsonPayload = ['distances' => [$d1, $d2]];

        $response = $httpClient->request('POST', $uri, ['json' => $jsonPayload]);

        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals(json_encode($expected), $response->getBody()->getContents());
    }


}
