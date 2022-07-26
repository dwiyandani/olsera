<?php

namespace Modules\ApiV1\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Modules\ApiV1\Services\Implements\ItemServiceImplements;
use Modules\ApiV1\Services\ItemService;

class ItemServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public $singletons = [
        ItemService::class => ItemServiceImplements::class
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ItemService::class];
    }
}