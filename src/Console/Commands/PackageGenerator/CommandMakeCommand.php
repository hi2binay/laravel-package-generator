<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator\Traits\ArtisanNamespace;
use Illuminate\Foundation\Console\ConsoleMakeCommand;

class CommandMakeCommand extends ConsoleMakeCommand
{
    use ArtisanNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:command {package} {name} {--command=}{--force}';


}
