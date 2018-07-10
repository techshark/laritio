<?php
declare(strict_types = 1);

return [
    /**
     * Library to be used by the SDK to communicate with
     * the publit.io API.
     *
     * Recommended: curl
     *
     * Default: fopen
     */
    'laritio_http_library' => env('LARITIO_HTTP_LIBRARY', 'fopen'),

    /**
     * Which version of the publit.io API the SDK should communitcate
     * with.
     *
     * Default: 1.0
     */
    'laritio_api_version' => env('LARITIO_API_VERSION', '1.0'),

    /**
     * Public API Key to be used by the SDK to authenticate
     * to the publit.io API.
     *
     * @see https://publit.io/docs/#getting-started
     *
     * Default: ''
     */
    'laritio_public_key' => env('LARITIO_PUBLIC_KEY', ''),

    /**
     * Private API Key to be used by the SDK to authenticate
     * to the publit.io API.
     *
     * @see https://publit.io/docs/#getting-started
     *
     * Default: ''
     */
    'laritio_private_key' => env('LARITIO_PRIVATE_KEY', ''),

    /**
     * The endpoint to which the SDK should point the requests.
     *
     * @see https://publit.io/docs
     *
     * Default: https://api.publit.io/
     */
    'laritio_api_endpoint' => env('LARITIO_API_ENDPOINT', 'https://api.publit.io/'),
];
