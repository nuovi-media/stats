<?php

namespace App\Providers;

use Facade\Ignition\SolutionProviders\BadMethodCallSolutionProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use JeroenNoten\LaravelAdminLte\Menu\Builder as MenuBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            $menu = config('menu');
            array_walk_recursive($menu, function (&$value, $key) {
                if (in_array($key, ['text', 'header'])) {
                    $value = __($value);
                } elseif ($key == 'url' and Str::startsWith($value, 'route:')) {
                    $value = route(substr($value, 6));
                }
            });

            foreach ($menu as $item) {
                $event->menu->add($item);
            }
        });
    }
}
