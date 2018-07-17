<?php
declare(strict_types=1);

namespace TechShark\Laritio\SDK\Requests;

use TechShark\Laritio\SDK\Requests\Interfaces\LaritioSDKRequestInterface;

/**
 * Class LaritioSDKRequest
 *
 * @author Tyler Brennan < info@techshark.nl >
 * @version 1.0
 */
class LaritioSDKRequest implements LaritioSDKRequestInterface
{
    /**
     * @var string
     */
    private $endpoint;
    /**
     * @var array
     */
    private $arguments;
    /**
     * @var string
     */
    private $httpMethod;

    /**
     * LaritioSDKRequest constructor.
     *
     * @param string $endpoint
     * @param array $arguments
     * @param string $httpMethod
     */
    public function __construct(string $endpoint, array $arguments = [], string $httpMethod = 'GET')
    {
        $this->endpoint = $endpoint;
        $this->arguments = $arguments;
        $this->httpMethod = $httpMethod;
    }

    /**
     * Should return the endpoint to which the
     * SDK point the request.
     *
     * Example: /files/create
     *
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Should return an array of arguments
     * the SDK should include in the API request.
     *
     * Example: ['arg1' => 'value1', 'arg2' => 'value2']
     *
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * Should return the HTTP method the
     * SDK should use for the API request.
     *
     * Example: 'GET'
     *
     * @return string
     */
    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }
}
