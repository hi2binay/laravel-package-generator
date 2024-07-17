<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use App\Console\Commands\PackageGenerator\Traits\ArtisanNamespace;

class ExceptionMakeCommand extends \Illuminate\Foundation\Console\ExceptionMakeCommand
{
    use ArtisanNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:exception {package} {name} {--render} {--report} {--f|force}';


}
