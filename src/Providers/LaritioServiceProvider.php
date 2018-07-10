<?php
declare(strict_types=1);

namespace TechShark\Laritio\Providers;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TechShark\Laritio\Managers\LaritioManager;

/**
 * Class LaritioServiceProvider
 *
 * @author Tyler Brennan < info@techshark.nl >
 * @version 1.0
 */
class LaritioServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function boot()
    {
       $this->publishes(
           [
               __DIR__ . '/../config/laritio.php' => config_path('laritio.php')
           ]
       );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            LaritioManager::class,
            function (Application $application) {
                $config = $application->make(Repository::class);

                $laritioManager = new LaritioManager();
                $laritioManager->setVersion(
                    $config->get('laritio.laritio_api_version')
                )
                ->setPublicKey(
                    $config->get('laritio.laritio_public_key')
                )
                ->setPrivateKey(
                    $config->get('laritio.laritio_private_key')
                )
                ->setLibrary(
                    $config->get('laritio.laritio_http_library')
                )
                ->setEndpoint(
                    $config->get('laritio.laritio_api_endpoint')
                );

                return $laritioManager;
            }
        );
    }
}
