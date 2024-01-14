<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:core';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new package';

    /**
     * Filesystem object
     *
     * @var Filesystem
     */
    protected Filesystem $filesystem;

    /**
     * PackageGenerator object
     *
     * @var Generator
     */
    protected Generator $packageGenerator;

    /**
     * Create a new command instance.
     *
     * @param Filesystem $filesystem
     * @param Generator $packageGenerator
     */
    public function __construct(
        Filesystem $filesystem,
        Generator  $packageGenerator
    )
    {
        $this->filesystem = $filesystem;

        $this->packageGenerator = $packageGenerator;

        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $path = $this->getSourceFilePath();

        if (!$this->filesystem->isDirectory($dir = dirname($path))) {
            $this->filesystem->makeDirectory($dir, 0777, true);
        }

        $contents = $this->getStubContents();

        if (!$this->filesystem->exists($path)) {
            $this->filesystem->put($path, $contents);
        } else {
            if ($this->option('force')) {
                $this->filesystem->put($path, $contents);
            } else {
                $this->error("File : {$path} already exists.");

                return;
            }
        }

        $this->info("File Created : {$path}");
    }

    /**
     * Get name in studly case.
     *
     * @return string
     */
    public function getStudlyName(): string
    {
        return class_basename($this->argument('package'));
    }

    /**
     * @return string
     */
    protected function getLowerName(): string
    {
        return strtolower(class_basename($this->argument('package')));
    }

    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return class_basename($this->argument('name'));
    }

    /**
     * @param string $name
     * @return string
     */
    protected function getClassNamespace(string $name): string
    {
        return str_replace('/', '\\', $name);
    }
}
