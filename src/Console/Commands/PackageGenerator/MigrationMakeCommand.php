<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;

class MigrationMakeCommand extends MigrateMakeCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:migration {package} {name : The name of the migration}
        {--create= : The table to be created}
        {--table= : The table to migrate}
        {--path= : The location where the migration file should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration (Deprecated)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new migration.';

    /**
     * Create a new migration install command instance.
     *
     * @param Composer $composer
     */
    public function __construct(Composer $composer)
    {
        $creator = new MigrationCreator((new Filesystem), null);
        parent::__construct($creator, $composer);

    }

    /**
     * Get the path to the migration directory.
     *
     * @return string
     */
    protected function getMigrationPath(): string
    {
        return base_path('packages/') . str_replace('\\', '/', $this->argument('package')) . '/database/migrations';
    }
}
