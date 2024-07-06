<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;


class PackageCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:make {package}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new package';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $package_name = trim($this->argument('package'));
        $this->packageGenerator->setConsole($this)
            ->configurePackage($package_name)
            ->generate();
    }
}
