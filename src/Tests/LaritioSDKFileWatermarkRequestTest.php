<?php

namespace TechShark\Laritio\Tests;

use TechShark\Laritio\SDK\Requests\LaritioSDKFileWatermarkRequest;
use PHPUnit\Framework\TestCase;

/**
 * Class LaritioSDKFileWatermarkRequestTest
 *
 * @author Tyler Brennan < info@techshark.nl >
 * @version 1.0
 */
class LaritioSDKFileWatermarkRequestTest extends TestCase
{

    /**
     *
     */
    public function testGetAction(): void
    {
        $laritioSDKWatermarkRequest = $this->getSDKFileRequestObject();

        $this->assertEquals('watermark', $laritioSDKWatermarkRequest->getAction());
    }

    /**
     *
     */
    public function testGetArguments(): void
    {
        $laritioSDKWatermarkRequest = $this->getSDKFileRequestObject();

        $this->assertArrayHasKey('name', $laritioSDKWatermarkRequest->getArguments());
        $this->assertArrayHasKey('position', $laritioSDKWatermarkRequest->getArguments());
        $this->assertArrayHasKey('padding', $laritioSDKWatermarkRequest->getArguments());

        $this->assertCount(3, $laritioSDKWatermarkRequest->getArguments());
    }

    /**
     *
     */
    public function testGetFilePath(): void
    {
        $laritioSDKWatermarkRequest = $this->getSDKFileRequestObject();
        $this->assertEquals('/images/example.png', $laritioSDKWatermarkRequest->getFilePath());
    }

    /**
     * @return LaritioSDKFileWatermarkRequest
     */
    private function getSDKFileRequestObject(): LaritioSDKFileWatermarkRequest
    {
        return new LaritioSDKFileWatermarkRequest(
            '/images/example.png',
            [
                'name' => 'mytestwm',
                'position' => 'bottom-right',
                'padding' => '20'
            ]
        );
    }
}
