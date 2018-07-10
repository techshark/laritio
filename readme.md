# Laritio
Laravel package for Publit.io PHP SDK.

# Installation
1. Register the LaritioServiceProvider in config/app.php
2. Execute php artisan vendor:publish and publish the Laritio config file.
3. Add your configuration values for Laritio to your .env

You're all done!

#Usage

**File upload**
```php
$laritioSDKFileRequest = new LaritioSDKFileRequest(
    '/images/example.png', 
    ['title' => 'example title']
);

$laritioSDK->uploadFile($laritioSDKFileRequest);
```

**Watermark**
```php
$laritioSDKWatermarkRequest = new LaritioSDKWatermarkRequest(
    '/images/example.png',
    [
        'name' => 'mytestwm', 
        'position' => 'bottom-right', 
        'padding' => '20'
    ]
);

$laritioSDK->uploadFile($laritioSDKWatermarkRequest);
```

**General request**

_adtags list as example._
```php
$laritioSDKRequest = new LaritioSDKRequest(
    '/players/adtags/list'
);

$laritioSDK->call($laritioSDKRequest);
```

For all possibilities see the publit.io API documentation at: https://publit.io/docs/?php#getting-started
