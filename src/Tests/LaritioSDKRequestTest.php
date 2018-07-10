<?php

namespace TechShark\Laritio\Tests;

use TechShark\Laritio\SDK\Requests\LaritioSDKRequest;
use PHPUnit\Framework\TestCase;

/**
 * Class LaritioSDKRequestTest
 *
 * @author Tyler Brennan < info@techshark.nl >
 * @version 1.0
 */
class LaritioSDKRequestTest extends TestCase
{

    /**
     *
     */
    public function testGetArguments(): void
    {
        $laritioSDKRequest = $this->getSDKFileRequestObject();

        $this->assertArrayHasKey('argument-1', $laritioSDKRequest->getArguments());
        $this->assertCount(1, $laritioSDKRequest->getArguments());
    }

    /**
     *
     */
    public function testGetEndpoint(): void
    {
        $laritioSDKRequest = $this->getSDKFileRequestObject();

        $this->assertEquals('/players/adtags/list', $laritioSDKRequest->getEndpoint());
    }

    /**
     *
     */
    public function testGetHttpMethod(): void
    {
        $laritioSDKRequest = $this->getSDKFileRequestObject();

        $this->assertEquals('PUT', $laritioSDKRequest->getHttpMethod());
    }

    /**
     * @return LaritioSDKRequest
     */
    private function getSDKFileRequestObject(): LaritioSDKRequest
    {
        return new LaritioSDKRequest(
            '/players/adtags/list',
            [
                'argument-1' => 'value-1'
            ],
            'PUT'
        );
    }
}
