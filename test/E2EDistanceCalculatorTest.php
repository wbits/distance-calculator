<?php

declare(strict_types=1);

namespace Assignment;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

final class E2EDistanceCalculatorTest extends TestCase
{
    /**
     * @dataProvider provider()
     */
    public function testItCanMakeARequestToCalculateTheSumOfDistances(
        array $d1,
        array $d2,
        string $expectedContent,
        int $expectedStatusCode
    )
    {
        $httpClient = new Client();
        $uri = 'http://localhost:2323/calculate/meter';
        $jsonPayload = ['distances' => [$d1, $d2]];

        $response = $httpClient->request('POST', $uri, ['json' => $jsonPayload]);

        self::assertEquals($expectedStatusCode, $response->getStatusCode());
        self::assertEquals($expectedContent, $response->getBody()->getContents());
    }

    public function provider(): array
    {
        return [
            [
                'd1' => ['measure'  => 'meter', 'distance' => 1.0],
                'd2' => ['measure'  => 'meter', 'distance' => 2.0],
                'expectedContent' => json_encode(['measure'  => 'meter', 'distance' => 3.0]),
                'expectedStatusCode' => 200,
            ]
        ];
    }
}
