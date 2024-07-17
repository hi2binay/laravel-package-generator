<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use App\Console\Commands\PackageGenerator\Traits\ArtisanNamespace;

class ScopeMakeCommand extends \Illuminate\Foundation\Console\ScopeMakeCommand
{
    use ArtisanNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:scope {package} {name} {--f|force}';


}
