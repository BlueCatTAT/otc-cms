<?php

namespace OtcCms\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use OtcCms\Models\CryptoCurrencyType;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Blade::directive('cryptoicon', function($type) {
            $string = <<<CODE
<?php
if ($type == %d) echo '<i class="mdi mdi-currency-btc"></i>';
elseif ($type == %d) echo '<i class="mdi mdi-currency-eth"></i>';
else echo '';
?>
CODE;
            return sprintf($string, CryptoCurrencyType::BITCOIN, CryptoCurrencyType::ETHEREUM);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if ($this->app->environment() === 'local') {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}
