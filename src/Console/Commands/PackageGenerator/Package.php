<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;

class Package
{
    protected Filesystem $filesystem;
    public Composer $composer;

    /**
     * The constructor.
     *
     * @param Composer $composer
     * @param Filesystem $filesystem
     */
    public function __construct(Composer $composer, Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
        $this->composer = $composer;
    }

    /**
     * Checks if package exist or not
     *
     * @param string $package
     * @return boolean
     */
    public function has(string $package): bool
    {
        return $this->filesystem->isDirectory(base_path('packages/' . $package));
    }

    /**
     * Deletes specific package
     *
     * @param string $package
     * @return void
     */
    public function delete(string $package): void
    {
        $this->filesystem->deleteDirectory(base_path('packages/' . $package));
    }
}
