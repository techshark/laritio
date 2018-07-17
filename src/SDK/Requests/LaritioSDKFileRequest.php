<?php
declare(strict_types=1);

namespace TechShark\Laritio\SDK\Requests;

use TechShark\Laritio\SDK\Requests\Interfaces\LaritioSDKFileRequestInterface;

/**
 * Class LaritioSDKFileRequests
 *
 * @author Tyler Brennan < info@techshark.nl >
 * @version 1.0
 */
class LaritioSDKFileRequest implements LaritioSDKFileRequestInterface
{
    /**
     * @var string
     */
    private $filePath;
    /**
     * @var string
     */
    private $action;
    /**
     * @var array
     */
    private $arguments;

    /**
     * LaritioSDKFileRequests constructor.
     *
     * @param string $filePath
     * @param array $arguments
     * @param string $action
     */
    public function __construct(string $filePath, array $arguments = [], string $action = 'file')
    {
        $this->filePath = $filePath;
        $this->action = $action;
        $this->arguments = $arguments;
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
     * The default action will always be "file".
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
