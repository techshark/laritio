<?php
declare(strict_types=1);

namespace TechShark\Laritio\SDK\Requests;

use TechShark\Laritio\SDK\Requests\Interfaces\LaritioSDKFileRequestInterface;

/**
 * Class LaritioSDKFileWatermarkRequest
 *
 * @author Tyler Brennan < info@techshark.nl >
 * @version 1.0
 */
class LaritioSDKFileWatermarkRequest implements LaritioSDKFileRequestInterface
{
    /**
     * @var string
     */
    private $filePath;
    /**
     * @var array
     */
    private $arguments;
    /**
     * @var string
     */
    private $action;

    /**
     * LaritioSDKFileWatermarkRequest constructor.
     *
     * @param string $filePath
     * @param array $arguments
     * @param string $action
     */
    public function __construct(string $filePath, array $arguments, string $action = 'watermark')
    {
        $this->filePath = $filePath;
        $this->arguments = $arguments;
        $this->action = $action;
    }

    /**
     * Should return the path towards the
     * file the SDK should upload to the publit.io API.
     *
     * Example: /path/to/my/file.extension
     *
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
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
     * Should return one of the following actions:
     * > file
     * > watermark
     * The default action will always be "watermark".
     *
     * no other actions are supported as of this moment.
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }
}
