<?php

namespace App\Providers;

use App\Traits\CombinePostCreateAndUpdate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    use CombinePostCreateAndUpdate;

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
        View::composer('admin.post.create_or_update', function($view) {
            $view->with([
                'availableData' => $this->getAllTagsSpeakersLocationsAndSurahs(),
                'formSettings' => $this->getFormSettingsForCreateOrUpdate(),
            ]);
        });
    }
}