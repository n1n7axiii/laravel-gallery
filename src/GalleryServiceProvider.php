<?php namespace N1n7aXIII\Gallery;

use Illuminate\Support\ServiceProvider;

class GalleryServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		require __DIR__.'/routes.php';

        $this->loadViewsFrom(__DIR__.'/views', 'gallery');

        $this->publishes([
            __DIR__.'/config/gallery.php' => config_path('gallery.php'),
            __DIR__.'/views' => base_path('resources/views/vendor/gallery'),
            __DIR__.'/database/migrations' => database_path('/migrations'),
        ]);

        if (glob(__DIR__.'/model/publish/*.php')) {
            $this->publishes([
                __DIR__.'/model/publish' => app_path('/'),
            ]);
            \File::deleteDirectory(__DIR__.'/model/publish/', true);
        }
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
