<?php

namespace LaravelCommands;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\Foundation\Console\PresetCommand;
use Illuminate\View\FileViewFinder;

class ServiceProvider extends BaseServiceProvider {

	public function boot(){

        if ($this->app->runningInConsole()) {
            $this->commands([
                \LaravelCommands\Console\Commands\AutoCompleteCommand::class,
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