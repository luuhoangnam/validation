<?php namespace Nam\Validation;

use Illuminate\Support\ServiceProvider;

/**
 * Class ValidationServiceProvider
 * @package Nam\Validation
 */
class ValidationServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->package('nam/validation');
    }
}
