<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator\Traits\ArtisanNamespace;

class MiddlewareMakeCommand extends \Illuminate\Routing\Console\MiddlewareMakeCommand
{
    use ArtisanNamespace;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:middleware {package} {name} {--test} {--pest} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new middleware.';

}
