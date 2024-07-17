<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use App\Console\Commands\PackageGenerator\Traits\ArtisanNamespace;

class JobMakeCommand extends \Illuminate\Foundation\Console\JobMakeCommand
{
    use ArtisanNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:job {package} {name} {--sync} {--test} {--pest} {--force}';


}
