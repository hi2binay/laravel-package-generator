<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

class MakeComposerCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:composer {package} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new mail.';

    /**
     * @return mixed
     */
    protected function getStubContents()
    {
        return $this->packageGenerator->getStubContents('composer', $this->getStubVariables());
    }

    /**
     * @return array
     */
    protected function getStubVariables()
    {
        $package = trim($this->argument('package'));
        return [
            'PACKAGE_NAME' => 'bkp/' . strtolower($this->getClassNamespace($package)),
            'PACKAGE_NAMESPACE' => $this->getClassNamespace(str_replace('\\', '\\\\', $package) . '\\\\'),
            'PHP_VERSION' => PHP_VERSION,
            'PACKAGE_DESCRIPTION' => 'This is package description',
            'PROVIDER_NAME' => basename($package)
        ];
    }

    /**
     * @return string
     */
    protected function getSourceFilePath()
    {
        $path = base_path('packages/' . $this->argument('package'));

        return $path . '/' . 'composer.json';
    }
}
