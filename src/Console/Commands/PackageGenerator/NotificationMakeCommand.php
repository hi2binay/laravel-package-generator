<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator\Traits\ArtisanNamespace;

class NotificationMakeCommand extends \Illuminate\Foundation\Console\NotificationMakeCommand
{
    use ArtisanNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:notification {package} {name} {--m|markdown=} {--f|force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new notification.';


}
