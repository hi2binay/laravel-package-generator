<?php
namespace BKP\LaravelPackageGenerator;

use BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator\{CastMakeCommand,
    ChannelMakeCommand,
    CommandMakeCommand,
    ControllerMakeCommand,
    EventMakeCommand,
    ExceptionMakeCommand,
    FactoryMakeCommand,
    JobMakeCommand,
    ListenerMakeCommand,
	LivewireMakeCommand,
    MailMakeCommand,
    MakeComposerCommand,
    MiddlewareMakeCommand,
    MigrationMakeCommand,
    ModelContractMakeCommand,
    ModelMakeCommand,
    NotificationMakeCommand,
    ObserverMakeCommand,
    PackageCommand,
    PackageProviderMakeCommand,
    PackageControllerMakeCommand,
    PackageRouteMakeCommand,
	PackageApiRouteMakeCommand,
    PolicyMakeCommand,
    ProviderMakeCommand,
    RequestMakeCommand,
    ResourceMakeCommand,
    RuleMakeCommand,
    ScopeMakeCommand,
    SeederMakeCommand,
    TestCaseMakeCommand,
    TestMakeCommand,
	TraitMakeCommand,
    ViewMakeCommand};
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class LaravelPackageGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->commands([
                PackageCommand::class,
                PackageProviderMakeCommand::class,
                PackageControllerMakeCommand::class,
                PackageRouteMakeCommand::class,
				PackageApiRouteMakeCommand::class,
                CastMakeCommand::class,
                ChannelMakeCommand::class,
                CommandMakeCommand::class,
                ControllerMakeCommand::class,
                EventMakeCommand::class,
                ExceptionMakeCommand::class,
                FactoryMakeCommand::class,
                JobMakeCommand::class,
                ListenerMakeCommand::class,
				LivewireMakeCommand::class,
                MailMakeCommand::class,
                MakeComposerCommand::class,
                MiddlewareMakeCommand::class,
                MigrationMakeCommand::class,
                ModelContractMakeCommand::class,
                ModelMakeCommand::class,
                NotificationMakeCommand::class,
                ObserverMakeCommand::class,
                PolicyMakeCommand::class,
                ProviderMakeCommand::class,
                RequestMakeCommand::class,
                ResourceMakeCommand::class,
                RuleMakeCommand::class,
                ScopeMakeCommand::class,
                SeederMakeCommand::class,
                TestCaseMakeCommand::class,
                TestMakeCommand::class,
				TraitMakeCommand::class,
                ViewMakeCommand::class
            ]);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {

    }
}
