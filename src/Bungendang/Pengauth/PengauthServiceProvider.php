<?php namespace Bungendang\Pengauth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory;
class PengauthServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('bungendang/pengauth');
		//include __DIR__.'/../../routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		 // Register 'underlyingclass' instance container to our UnderlyingClass object
        $this->app['pengauth'] = $this->app->share(function($app)
        {
            return new Pengauth;
        });
        //\App::bind('Pengauth', function()
		//{
	    //return new \Bungendang\Pengauth;
		//});

        // Shortcut so developers don't need to add an Alias in app/config/app.php
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Pengauth', 'Bungendang\Pengauth\Facades\Pengauth');
        });
	}
	
	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
