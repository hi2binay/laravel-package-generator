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
        $packageName = trim($this->argument('package'));
        $pkg_array = explode("\\", $packageName);
        $pkg_replace_array = [];
        foreach($pkg_array as $a) {
            $pkg_replace_array[] = Str::kebab($a);
        }
        $package_dir = implode(DIRECTORY_SEPARATOR, $pkg_replace_array);
        $package_db_path = base_path('packages'.DIRECTORY_SEPARATOR) . $package_dir . DIRECTORY_SEPARATOR.'database';
        if (is_dir($package_db_path . DIRECTORY_SEPARATOR.'seeds')) {
            return $package_db_path . DIRECTORY_SEPARATOR.'seeds'.DIRECTORY_SEPARATOR . $name . '.php';
        }

        return $package_db_path . DIRECTORY_SEPARATOR.'seeders'.DIRECTORY_SEPARATOR . str_replace('\\', '/', $name) . '.php';
    }
}
