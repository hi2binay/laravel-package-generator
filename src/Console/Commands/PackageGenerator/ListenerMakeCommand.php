<?php

namespace BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator;

use BKP\LaravelPackageGenerator\Console\Commands\PackageGenerator\Traits\ArtisanNamespace;
use Illuminate\Support\Str;

class ListenerMakeCommand extends \Illuminate\Foundation\Console\ListenerMakeCommand
{
    use ArtisanNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:listener {package} {name} {--e|event=} {--queued} {--test} {--pest} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a package new listener.';

    /**
     * Build the class with the given name.
     *
     * @param string $name
     * @return string
     */
    protected function buildClass($name)
    {
        $event = $this->option('event') ?? '';

        if (!Str::startsWith($event, [
            $this->rootNamespace(),
            'Illuminate',
            '\\',
        ])) {
            $event = $this->rootNamespace() . 'Events\\' . str_replace('/', '\\', $event);
        }

        $stub = str_replace(
            ['DummyEvent', '{{ event }}'], $event, parent::buildClass($name)
        );

        return str_replace('BKP\LaravelPackageGenerator\\Events', $this->argument('package') . '\\Events', str_replace(
            ['DummyFullEvent', '{{ eventNamespace }}'], trim($event, '\\'), $stub
        ));
    }
}
