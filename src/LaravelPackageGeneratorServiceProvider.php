<?php
namespace BKP\LaravelPackageGenerator;

use BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator\{CastMakeCommand,
    ChannelMakeCommand,
    CommandMakeCommand,
    ConsoleCommandMakeCommand,
    ControllerMakeCommand,
    EventMakeCommand,
    ExceptionMakeCommand,
    FactoryMakeCommand,
    JobMakeCommand,
    ListenerMakeCommand,
    MailMakeCommand,
    MakeComposerCommand,
    MiddlewareMakeCommand,
    MigrationMakeCommand,
    ModelContractMakeCommand,
    ModelMakeCommand,
    NotificationMakeCommand,
    ObserverMakeCommand,
    PackageCommand,
    PackageRouteMakeCommand,
    PolicyMakeCommand,
    ProviderMakeCommand,
    RequestMakeCommand,
    ResourceMakeCommand,
    RuleMakeCommand,
    ScopeMakeCommand,
    SeederMakeCommand,
    TestCaseMakeCommand,
    TestMakeCommand,
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
                PackageRouteMakeCommand::class,
                CastMakeCommand::class,
                ChannelMakeCommand::class,
                CommandMakeCommand::class,
                ConsoleCommandMakeCommand::class,
                ControllerMakeCommand::class,
                EventMakeCommand::class,
                ExceptionMakeCommand::class,
                FactoryMakeCommand::class,
                JobMakeCommand::class,
                ListenerMakeCommand::class,
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
