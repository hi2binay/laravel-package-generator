<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use Illuminate\Support\Str;

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

        $pkg = explode("\\", $this->packageName);
        $name = Str::studly($pkg[0]);

        return [
            'PACKAGE_NAME' => 'bkp/' .str_replace('\\','',Str::kebab($this->packageNamespace)),
            'PACKAGE_NAMESPACE' => $this->getClassNamespace(str_replace('\\', '\\\\', $this->packageNamespace) . '\\\\'),
            'PHP_VERSION' => PHP_VERSION,
            'PACKAGE_DESCRIPTION' => 'This is package description',
            'PROVIDER_NAME' => $name
        ];
    }

    /**
     * @return string
     */
    protected function getSourceFilePath()
    {
        $path = base_path('packages'.DIRECTORY_SEPARATOR . $this->packageFolder);

        return $path . DIRECTORY_SEPARATOR . 'composer.json';
    }
}
