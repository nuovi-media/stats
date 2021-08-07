<?php

namespace App\Providers;

use Facade\Ignition\SolutionProviders\BadMethodCallSolutionProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
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
            array_walk_recursive($menu, fn(&$value, $key) => $value = in_array($key, ['text', 'header']) ? __($value) : $value);

            foreach ($menu as $item) {
                $event->menu->add($item);
            }
        });
    }
}
