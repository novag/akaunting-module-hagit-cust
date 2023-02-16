<?php

namespace Modules\HagitCust\Providers;

use Modules\HagitCust\View\Composers\DocumentTemplateDefaultComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposer extends ServiceProvider
{
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
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('components.documents.template.default', DocumentTemplateDefaultComposer::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
