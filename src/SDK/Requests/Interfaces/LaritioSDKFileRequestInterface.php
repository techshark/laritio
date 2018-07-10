<?php

namespace TechShark\Laritio\SDK\Requests\Interfaces;

/**
 * Interface LaritioSDKFileRequestInterface
 *
 * @author Tyler Brennan < info@techshark.nl >
 * @version 1.0
 */
interface LaritioSDKFileRequestInterface
{
    /**
     * Should return the path towards the
     * file the SDK should upload to the publit.io API.
     *
     * Example: /path/to/my/file.extension
     *
     * @return string
     */
    public function getFilePath(): string;

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
     * Should return one of the following actions:
     * > file
     * > watermark
     * The default action will always be "file".
     *
     * no other actions are supported as of this moment.
     *
     * @return string
     */
    public function getAction(): string;
}
