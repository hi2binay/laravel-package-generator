<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use App\Console\Commands\PackageGenerator\Traits\ArtisanNamespace;

class CastMakeCommand extends \Illuminate\Foundation\Console\CastMakeCommand
{
    use ArtisanNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:cast {package} {name} {--inbound} {--force}';


}
