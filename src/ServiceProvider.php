<?php

namespace PackageMacroAutocomplete;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider {

	public function boot(){

        if ($this->app->runningInConsole()) {
            $this->commands([
                \PackageMacroAutocomplete\Console\Commands\AutoCompleteCommand::class,
            ]);

        }

	}

	/**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {

    }

	
}