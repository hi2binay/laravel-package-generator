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

        return [
            'PACKAGE_NAME' => 'bkp/' .$this->packageFolder,
            'PACKAGE_NAMESPACE' => $this->getClassNamespace(str_replace('\\', '\\\\', $this->packageNamespace) . '\\\\'),
            'PHP_VERSION' => PHP_VERSION,
            'PACKAGE_DESCRIPTION' => 'This is package description',
            'PROVIDER_NAME' => basename($this->packageNamespace)
        ];
    }

    /**
     * @return string
     */
    protected function getSourceFilePath()
    {
        $path = base_path('packages/' . $this->packageFolder);

        return $path . '/' . 'composer.json';
    }
}
