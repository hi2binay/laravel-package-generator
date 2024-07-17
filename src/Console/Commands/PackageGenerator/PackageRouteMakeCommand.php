<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;
use Illuminate\Support\Str;

class PackageRouteMakeCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:make-route {package} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a package route file.';

    /**
     * @return mixed
     */
    protected function getStubContents()
    {
        return $this->packageGenerator->getStubContents('web', $this->getStubVariables());
    }

    /**
     * @return array
     */
    protected function getStubVariables()
    {
        $pkg_array = explode("\\",$this->packageName);
        $route_as = strtolower(implode('-', $pkg_array));
        return [
            'CONTROLLER_CLASS_NAME' => $this->getClassNamespace($this->packageNamespace . '/Http/Controllers/' . $this->getStudlyName() . 'Controller'),
            'LOWER_NAME' => str_replace('\\','/',$this->getLowerName()),
            'PACKAGE_NAMESPACE' =>$this->getStudlyName(),
            'LOWER_PACKAGE_NAME' => $route_as
        ];
    }

    /**
     * @return string
     */
    protected function getSourceFilePath()
    {
        $path = base_path('packages'.DIRECTORY_SEPARATOR . $this->packageFolder) . DIRECTORY_SEPARATOR.'routes';

        return $path . DIRECTORY_SEPARATOR.'web.php';
    }
}
