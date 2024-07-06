<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use Illuminate\Support\Str;

class SeederMakeCommand extends \Illuminate\Database\Console\Seeds\SeederMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:seeder {package} {name} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new seeder.';

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace(): string
    {

        return Str::studly(str_replace('-',' ', trim($this->argument('package')))) . '\\Database\Seeders\\';
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name): string
    {
        $name = str_replace('\\', '/', Str::replaceFirst($this->rootNamespace(), '', $name));
        $pkg_dir = Str::kebab(str_replace('-',' ', trim($this->argument('package'))));
        $package_db_path = base_path('packages/') . $pkg_dir . '/database';
        if (is_dir($package_db_path . '/seeds')) {
            return $package_db_path . '/seeds/' . $name . '.php';
        }

        return $package_db_path . '/seeders/' . str_replace('\\', '/', $name) . '.php';
    }
}
