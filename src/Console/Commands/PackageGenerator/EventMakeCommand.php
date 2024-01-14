<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator\Traits\ArtisanNamespace;

class EventMakeCommand extends \Illuminate\Foundation\Console\EventMakeCommand
{
    use ArtisanNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:event {package} {name} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new event.';


}
