<?php

namespace TechShark\Laritio\SDK\Requests\Interfaces;

/**
 * Interface LaritioSDKRequestInterface
 *
 * @author Tyler Brennan < info@techshark.nl >
 * @version 1.0
 */
interface LaritioSDKRequestInterface
{
    /**
     * Should return the endpoint to which the
     * SDK point the request.
     *
     * Example: /files/create
     *
     * @return string
     */
    public function getEndpoint(): string;

    /**
     * Should return an array of arguments
     * the SDK should include in the API request.
     *
     * Example: ['arg1' => 'value1', 'arg2' => 'value2']
     *
     * @return array
     */
    public function getArguments(): array;

    /**
     * Should return the HTTP method the
     * SDK should use for the API request.
     *
     * Example: 'GET'
     *
     * @return string
     */
    public function getHttpMethod(): string;
}
