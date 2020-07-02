<?php

declare(strict_types=1);

namespace Assignment;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

final class E2EDistanceCalculatorTest extends TestCase
{
    private $client;
    private $uri;

    protected function setUp()
    {
        $this->client = new Client();
        $this->uri = 'http://localhost:2323/calculate/meter';
    }

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
        $response = $this->callTheApi(['distances' => [$d1, $d2]]);

        self::assertEquals($expectedStatusCode, $response->getStatusCode());
        self::assertEquals($expectedContent, $response->getBody()->getContents());
    }

    public function provider(): array
    {
        return [
            [
                'd1' => ['measure'  => 'meter', 'distance' => 1.0],
                'd2' => ['measure'  => 'meter', 'distance' => 2.0],
                'expectedContent' => json_encode(['measure' => 'meter', 'distance' => 3.0]),
                'expectedStatusCode' => 200,
            ],
            [
                'd1' => ['measure'  => 'invalid', 'distance' => 1.0],
                'd2' => ['measure'  => 'meter', 'distance' => 2.0],
                'expectedContent' => json_encode(['errors' => ['Invalid measure']]),
                'expectedStatusCode' => 422,
            ],
        ];
    }

    private function callTheApi(array $json): ResponseInterface
    {
        try {
            return $this->client->request('POST', $this->uri, ['json' => $json]);
        } catch (ClientException $e) {
            if ($e->hasResponse()) {
                return $e->getResponse();
            }
        }
    }
}
