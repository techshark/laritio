<?php

namespace TechShark\Laritio\Tests;

use PHPUnit\Framework\TestCase;
use TechShark\Laritio\SDK\Requests\LaritioSDKFileRequest;

/**
 * Class LaritioSDKFileRequestTest
 *
 * @author Tyler Brennan < info@techshark.nl >
 * @version 1.0
 */
class LaritioSDKFileRequestTest extends TestCase
{

    /**
     *
     */
    public function testGetAction(): void
    {
        $laritioSDKFileRequest = $this->getSDKFileRequestObject();
        $this->assertEquals('action-test', $laritioSDKFileRequest->getAction());
    }

    /**
     *
     */
    public function testGetArguments(): void
    {
        $laritioSDKFileRequest = $this->getSDKFileRequestObject();
        $this->assertArrayHasKey('title', $laritioSDKFileRequest->getArguments());
        $this->assertCount(1, $laritioSDKFileRequest->getArguments());
    }

    /**
     *
     */
    public function testGetFilePath(): void
    {
        $laritioSDKFileRequest = $this->getSDKFileRequestObject();
        $this->assertEquals('/images/example.png', $laritioSDKFileRequest->getFilePath());
    }

    /**
     * @return LaritioSDKFileRequest
     */
    private function getSDKFileRequestObject(): LaritioSDKFileRequest
    {
        return new LaritioSDKFileRequest(
            '/images/example.png',
            ['title' => 'example title'],
            'action-test'
        );
    }
}
