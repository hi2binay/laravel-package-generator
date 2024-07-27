<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use Illuminate\Support\Str;
use Livewire\Features\SupportConsoleCommands\Commands\ComponentParser;
use Illuminate\Support\Facades\File;

class LivewireMakeCommand extends \Livewire\Features\SupportConsoleCommands\Commands\MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:livewire {package} {name} {--force} {--inline} {--test} {--pest} {--stub=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new livewire component';

    public function setParser()
    {

        $packageName = trim($this->argument('package'));
        $pkg_array = explode("\\", $packageName);
        $pkg_replace_array = [];
        foreach($pkg_array as $a) {
            $pkg_replace_array[] = Str::kebab($a);
        }
        $package_dir = implode(DIRECTORY_SEPARATOR, $pkg_replace_array);
        $view_path = base_path('packages'.DIRECTORY_SEPARATOR) . $package_dir . DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'livewire';
        $class_namespace = Str::studly(str_replace('-',' ', trim($this->argument('package')))) . '\\Livewire';
        config(['livewire.class_namespace'=> $class_namespace]);
        //$class_namespace = config('livewire.class_namespace');
        //$view_path = config('livewire.view_path');

        $this->parser = new ComponentParser(
            $class_namespace,
            $view_path,
            $this->argument('name'),
            $this->option('stub')
        );

    }

    protected function createClass($force = false, $inline = false)
    {
        $this->setParser();

        $classPath = $this->parser->classPath();
        $classPath = base_path('packages'.DIRECTORY_SEPARATOR).$this->parser->classNamespace();
        $classPath = str_replace('Livewire','src'.DIRECTORY_SEPARATOR.'Livewire', $classPath).DIRECTORY_SEPARATOR.$this->parser->classFile();

        if (File::exists($classPath) && ! $force) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS-IE-TOOTLES </> 😳 \n");
            $this->line("<fg=red;options=bold>Class already exists:</> {$this->parser->relativeClassPath()}");

            return false;
        }

        $this->ensureDirectoryExists($classPath);

        File::put($classPath, $this->parser->classContents($inline));

        return $classPath;
    }

    protected function createView($force = false, $inline = false)
    {
        if ($inline) {
            return false;
        }

        $this->setParser();

        $viewPath = $this->parser->viewPath();

        if (File::exists($viewPath) && ! $force) {
            $this->line("<fg=red;options=bold>View already exists:</> {$this->parser->relativeViewPath()}");

            return false;
        }

        $this->ensureDirectoryExists($viewPath);

        File::put($viewPath, $this->parser->viewContents());

        return $viewPath;
    }

}
