<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;
use Illuminate\Support\Str;

class ModelContractMakeCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:make-model-contract {name} {package} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model contract.';

    /**
     * @return mixed
     */
    protected function getStubContents()
    {
        return $this->packageGenerator->getStubContents('model-contract', $this->getStubVariables());
    }

    /**
     * @return array
     */
    protected function getStubVariables()
    {
        return [
            'NAMESPACE' => $this->getClassNamespace($this->argument('package') . '/Contracts'),
            'CLASS' => $this->getClassName(),
        ];
    }

    /**
     * @return string
     */
    protected function getSourceFilePath()
    {
        $packageName = trim($this->argument('package'));
        $pkg_array = explode("\\", $packageName);
        $pkg_replace_array = [];
        foreach($pkg_array as $a) {
            $pkg_replace_array[] = Str::kebab($a);
        }
        $package_dir = implode(DIRECTORY_SEPARATOR, $pkg_replace_array);
        $path = base_path('packages'.DIRECTORY_SEPARATOR . $package_dir) . DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Contracts';

        return $path . DIRECTORY_SEPARATOR . $this->getClassName() . '.php';
    }

}
