<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use App\Console\Commands\PackageGenerator\Traits\ArtisanNamespace;
use Illuminate\Support\Str;

class ModelMakeCommand extends \Illuminate\Foundation\Console\ModelMakeCommand
{
    use ArtisanNamespace;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:model {package} {name} {--pivot} {--morph-pivot} {--a|all} {--force} {--f|factory}  {--m|migration} {--s|seed} {--c|controller} {--r|resource} {--api} {--p|policy} {--R|requests}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return false;
        }

    }

    /**
     * Create a model factory for the model.
     *
     * @return void
     */
    protected function createFactory()
    {
        $factory = Str::studly($this->argument('name'));

        $this->call('package:factory', [
            'package' => $this->argument('package'),
            'name' => "{$factory}Factory",
            '--model' => $this->argument('name'),
            '--force' => 1
        ]);
    }

    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::snake(Str::pluralStudly(class_basename($this->argument('name'))));

        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }

        $this->call('package:migration', [
            'package' => $this->argument('package'),
            'name' => "create_{$table}_table",
            '--create' => $table,
            '--fullpath' => true,
        ]);
    }

    /**
     * Create a seeder file for the model.
     *
     * @return void
     */
    protected function createSeeder()
    {
        $seeder = Str::studly(class_basename($this->argument('name')));

        $this->call('package:seeder', [
            'package' => $this->argument('package'),
            'name' => "{$seeder}Seeder",
            '--force' => 1
        ]);
    }

    /**
     * Create a controller for the model.
     *
     * @return void
     */
    protected function createController()
    {
        $controller = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('package:controller', array_filter([
            'package' => $this->argument('package'),
            'name' => "{$controller}Controller",
            '--model' => $this->option('resource') || $this->option('api') ? $modelName : null,
            '--api' => $this->option('api'),
            '--requests' => $this->option('requests') || $this->option('all'),
            '--test' => $this->option('test'),
            '--pest' => $this->option('pest')
        ]));
    }

    /**
     * Create a policy file for the model.
     *
     * @return void
     */
    protected function createPolicy()
    {
        $policy = Str::studly(class_basename($this->argument('name')));

        $this->call('package:policy', [
            'package' => $this->argument('package'),
            'name' => "{$policy}Policy",
            '--model' => $this->qualifyClass($this->getNameInput()),
            '--force' => 1
        ]);
    }


}
