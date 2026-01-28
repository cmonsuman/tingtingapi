<?php

namespace TingTing\Laravel\Tests;

use PHPUnit\Framework\TestCase;
use TingTing\Laravel\TingTingClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use TingTing\Laravel\Exceptions\TingTingApiException;

class TingTingClientTest extends TestCase
{
    public function test_client_can_be_instantiated()
    {
        $config = [
            'base_url' => 'https://app.tingting.io/api/v1/',
            'public_key' => 'test-public-key',
            'private_key' => 'test-private-key',
        ];

        $client = new TingTingClient($config);
        $this->assertInstanceOf(TingTingClient::class, $client);
    }

    public function test_request_includes_auth_headers()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['status' => 'success'])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $guzzleClient = new Client(['handler' => $handlerStack]);

        $config = [
            'base_url' => 'https://app.tingting.io/api/v1/',
            'api_token' => 'test-api-token',
        ];

        $client = new TingTingClient($config);
        
        // Injecting the mocked guzzle client via reflection for testing
        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('client');
        $property->setAccessible(true);
        $property->setValue($client, $guzzleClient);

        $response = $client->userDetail();

        $this->assertEquals(['status' => 'success'], $response);
        
        $lastRequest = $mock->getLastRequest();
        $this->assertEquals('Bearer test-api-token', $lastRequest->getHeaderLine('Authorization'));
    }

    public function test_bearer_token_auth()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['status' => 'success'])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $guzzleClient = new Client(['handler' => $handlerStack]);

        $config = ['base_url' => 'https://app.tingting.io/api/v1/'];
        $client = new TingTingClient($config);
        $client->setToken('test-token');

        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('client');
        $property->setAccessible(true);
        $property->setValue($client, $guzzleClient);

        $client->userDetail();

        $lastRequest = $mock->getLastRequest();
        $this->assertEquals('Bearer test-token', $lastRequest->getHeaderLine('Authorization'));
    }

    public function test_request_throws_exception_on_error()
    {
        $mock = new MockHandler([
            new Response(401, [], json_encode(['message' => 'Unauthorized access'])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $guzzleClient = new Client(['handler' => $handlerStack]);

        $config = ['base_url' => 'https://app.tingting.io/api/v1/'];
        $client = new TingTingClient($config);

        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('client');
        $property->setAccessible(true);
        $property->setValue($client, $guzzleClient);

        try {
            $client->userDetail();
            $this->fail('Expected TingTingApiException was not thrown');
        } catch (TingTingApiException $e) {
            $this->assertEquals('Unauthorized access', $e->getMessage());
            $this->assertEquals(401, $e->getCode());
            $this->assertEquals(['message' => 'Unauthorized access'], $e->getData());
        }
    }

    public function test_list_campaigns_with_filters()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['results' => []])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $guzzleClient = new Client(['handler' => $handlerStack]);

        $config = ['base_url' => 'https://app.tingting.io/api/v1/'];
        $client = new TingTingClient($config);

        $reflection = new \ReflectionClass($client);
        $property = $reflection->getProperty('client');
        $property->setAccessible(true);
        $property->setValue($client, $guzzleClient);

        $filters = ['limit' => 10, 'status' => 'Completed'];
        $client->listCampaigns($filters);

        $lastRequest = $mock->getLastRequest();
        $this->assertEquals('limit=10&status=Completed', $lastRequest->getUri()->getQuery());
    }
}
