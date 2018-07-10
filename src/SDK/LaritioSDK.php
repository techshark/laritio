<?php
declare(strict_types=1);

namespace TechShark\Laritio\SDK;

use TechShark\Laritio\Managers\LaritioManager;
use TechShark\Laritio\SDK\Requests\Interfaces\LaritioSDKFileRequestInterface;
use TechShark\Laritio\SDK\Requests\Interfaces\LaritioSDKRequestInterface;

/**
 * Class LaritioSDK
 *
 * @author Tyler Brennan < info@techshark.nl >
 * @version 1.0
 */
class LaritioSDK
{
    /**
     * @var LaritioManager
     */
    private $laritioManager;

    /**
     * LaritioSDK constructor.
     *
     * @param LaritioManager $laritioManager
     */
    public function __construct(LaritioManager $laritioManager)
    {
        $this->laritioManager = $laritioManager;
    }

    /**
     * Fire an API call.
     *
     * @param LaritioSDKRequestInterface $SDKRequest
     *
     * @return bool|string
     */
    public function call(LaritioSDKRequestInterface $SDKRequest)
    {
        $fullUrl = $this->buildUrl($SDKRequest->getEndpoint(), $SDKRequest->getArguments());

        if ($this->laritioManager->getLibrary() === 'curl') {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $SDKRequest->getHttpMethod());
            curl_setopt($curl, CURLOPT_URL, $fullUrl);

            $response = curl_exec($curl);
            curl_close($curl);
        } else if ($SDKRequest->getHttpMethod() === 'GET') {
            $response = file_get_contents($fullUrl);
        } else {
            $response = 'Error: Given library is not supported at this time.';
        }

        $unserialized_response = @unserialize($response);

        return $unserialized_response ?: $response;
    }

    /**
     * Upload a file.
     *
     * @param LaritioSDKFileRequestInterface $SDKFileRequest
     *
     * @return string
     */
    public function uploadFile(LaritioSDKFileRequestInterface $SDKFileRequest): string
    {
        $url = $this->buildUrl('/files/create', $SDKFileRequest->getArguments());
        if ($SDKFileRequest->getAction() === 'watermark') {
            $url = $this->buildUrl('/watermarks/create', $SDKFileRequest->getArguments());
        }

        /**
         * A new variable included with curl in PHP 5.5 - CURLOPT_SAFE_UPLOAD - prevents the
         * '@' modifier from working for security reasons (in PHP 5.6, the default value is true)
         *
         * @see http://stackoverflow.com/a/25934129
         * @see http://php.net/manual/en/migration56.changed-functions.php
         * @see http://comments.gmane.org/gmane.comp.php.devel/87521
         */
        $postData = array('file' => new \CURLFile($SDKFileRequest->getFilePath()));
        if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50500) {
            $postData = array('file' => '@' . $SDKFileRequest->getFilePath());
        }

        if ($this->laritioManager->getLibrary() === 'curl') {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
            $response = curl_exec($curl);
            $errNo = curl_errno($curl);
            $errMsg = curl_error($curl);
            curl_close($curl);
        } else {
            $response = 'Given library is not supported at this time.';
        }

        if ($errNo > 0) {
            return 'Error #' . $errNo . ': ' . ($errMsg ?? '');
        }

        return $response;
    }

    /**
     * Build url.
     *
     * @param string $endpoint
     * @param array $args
     *
     * @return string
     */
    private function buildUrl(string $endpoint, array $args = []): string
    {
        return $this->laritioManager->getEndpoint() . 'v' . $this->laritioManager->getVersion() . $endpoint . '?' . http_build_query($this->buildArguments($args), '', '&');
    }

    /**
     * Build argument(s) array.
     *
     * @param array $arguments
     *
     * @return array
     */
    private function buildArguments(array $arguments): array
    {
        $arguments['api_nonce'] = str_pad(random_int(0, 99999999), 8, STR_PAD_LEFT);
        $arguments['api_timestamp'] = time();
        $arguments['api_key'] = $this->laritioManager->getPublicKey();

        if (!array_key_exists('api_format', $arguments)) {
            // Use the serialised PHP format,
            // otherwise use format specified in the call() arguments.
            $arguments['api_format'] = 'php';
        }

        // Add API kit version
        $arguments['api_kit'] = 'php-' . $this->laritioManager->getVersion();

        // Sign the array of arguments
        //$arguments['api_signature'] = $this->sign($arguments);
        $arguments['api_signature'] = sha1($arguments['api_timestamp'] . $arguments['api_nonce'] . $this->laritioManager->getPrivateKey());

        return $arguments;
    }

    /**
     * Sign API call arguments
     *
     * @param array $arguments
     *
     * @return string
     */
    private function sign(array $arguments): string
    {
        ksort($arguments);
        $signedBaseString = '';
        foreach ($arguments as $key => $value) {
            if ($signedBaseString !== '') {
                $signedBaseString .= '&';
            }
            // Construct Signature Base String
            $signedBaseString .= $this->urlEncode($key) . '=' . $this->urlEncode($value);
        }

        // Add shared secret to the Signature Base String and generate the signature
        return sha1($signedBaseString . $this->laritioManager->getPrivateKey());
    }

    /**
     * RFC 3986 complient rawurlencode()
     * Only required for phpversion() <= 5.2.7RC1
     *
     * @see http://www.php.net/manual/en/function.rawurlencode.php#86506
     *
     * @var mixed $input
     *
     * @return array|string
     */
    private function urlEncode($input)
    {
        $response = '';
        if (is_array($input)) {
            $response = array_map(array('_urlencode'), $input);
        } else if (is_scalar($input)) {
            $response = str_replace('+', ' ', str_replace('%7E', '~', rawurlencode($input)));
        }

        return $response;
    }
}
