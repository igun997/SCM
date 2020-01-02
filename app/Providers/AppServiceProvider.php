<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      require_once app_path('Helpers/StatusHelper.php');
      require_once app_path('Helpers/KonversiUnit.php');
      require_once app_path('Helpers/AlgoritmaClass.php');
      require_once app_path('Helpers/Pengaturan.php');
      if ($this->app->environment() !== 'production') {
           $this->app->register(\Way\Generators\GeneratorsServiceProvider::class);
           $this->app->register(\Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
           $this->app->register(\Reliese\Coders\CodersServiceProvider::class);
           $this->app->register(\Sven\ArtisanView\ServiceProvider::class);
       }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      config(['app.locale' => 'id']);
      \Carbon\Carbon::setLocale('id');
      date_default_timezone_set('Asia/Jakarta');
    }
}
