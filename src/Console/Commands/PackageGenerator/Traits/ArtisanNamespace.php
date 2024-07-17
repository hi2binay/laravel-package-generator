<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator\Traits;

use Illuminate\Support\Str;

trait  ArtisanNamespace
{

    /**
     * package dir
     */
    public $packageDir = null;

    /**
     * Package namespace
     */
    public $packageNamespace = null;

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name): string
    {
        $this->setDirAndNamespace();
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path(DIRECTORY_SEPARATOR.'packages'.DIRECTORY_SEPARATOR) . $this->packageDir . DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace(): string
    {
        $this->setDirAndNamespace();

        return $this->packageNamespace . '\\';
    }

    /**
     * set package dir and namespace
     */
    public function setDirAndNamespace() {
        $packageName = trim($this->argument('package'));
        $this->packageNamespace = Str::studly($packageName);
        $pkg_array = explode("\\", $packageName);
        $pkg_replace_array = [];
        foreach($pkg_array as $a) {
            $pkg_replace_array[] = Str::kebab($a);
        }
        $this->packageDir = implode(DIRECTORY_SEPARATOR, $pkg_replace_array);
    }
}
