<?php

class IndexJsonApiResponseTest extends PHPUnit_Framework_TestCase
{
    public function testPrepare()
    {
        $indexResponse = new \Morilog\JsonApi\Responses\IndexJsonApiResponse('testData', [
            'first_name' => 'morteza',
            'last_name' => 'parvini'
        ], [
            'url' => 'http://morilog.ir'
        ]);

        $response = $indexResponse->getResponse();

        $this->assertTrue(json_decode($response->getContent(), true)['data']['mainKey'] === 'testData');
        $this->assertTrue(json_decode($response->getContent(),
                true)['status'] === \Morilog\JsonApi\ResponseStatuses::SUCCESS);
        
        $this->assertTrue(json_decode($response->getContent(), true)['data']['url'] === 'http://morilog.ir');
        
        $this->assertTrue($response->getStatusCode() === 200);
        $this->assertTrue($response->headers->contains('content-type', 'application/json'));
    }
}